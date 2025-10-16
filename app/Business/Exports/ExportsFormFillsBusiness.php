<?php

namespace App\Business\Exports;

use App\Business\BaseBusiness;
use App\Business\Permissions\PermissionsValidationBusiness;
use App\Database\Entities\CustomForms\CustomFormEntity;
use App\Database\Entities\CustomForms\FormFillEntity;
use App\Database\Entities\Services\ServiceEntity;
use App\Database\Models\CustomForms\CustomFormsModel;
use App\Database\Models\CustomForms\FormFillsModel;
use App\Database\Models\Services\ServicesModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;

class ExportsFormFillsBusiness
{
    use BaseBusiness;

    private FormFillsModel $formFillsModel;
    private CustomFormsModel $customForms;
    private ServicesModel $servicesModel;

    public function __construct()
    {
        $this->customForms = new CustomFormsModel();
        $this->formFillsModel = new FormFillsModel();
        $this->servicesModel = new ServicesModel();
    }

    public function fixProblemWithUrlFiles(string $url)
    {
        $paths = explode("\writable\\", preg_replace('/\\f/', '/f', $url));

        if (count($paths) == 2)
            return WRITEPATH . $paths[1];
        else return $url;
    }

    /** 
     * @param array{int} $fieldIds
     */
    public function getData(array $fieldIds): array
    {
        helper(['dates', 'string']);

        $this->formFillsModel->whereIn("id", $fieldIds);
        $payload = [];

        $payload = PermissionsValidationBusiness::applyOwnershipRestriction([
            'scope' => 'clients',
            'type' => 'VIEW'
        ], $payload);

        /** 
         * @var FormFillEntity
         */
        $foundFillFieldById = $this->formFillsModel->where($payload)->first();
        /** 
         * @var FormFillEntity
         */
        $foundAllFillsByPackage = $this->formFillsModel->where("package", $foundFillFieldById->getPackage())->findAll();

        /** 
         * @var CustomFormEntity
         */
        $foundForm = $this->customForms->where([
            "id" => $foundFillFieldById->getFormId()
        ])->first();

        /** @var array{Object} */
        $fields = \json_decode($foundForm->getComponents());

        $formsData = [
            "title" => cleanString($foundForm->getName()),
            "description" => $foundForm->getDescription(),
            "filledAt" => $foundFillFieldById->getCreatedAt(),
            "fields" => [],
            "files" => []
        ];

        if (!empty($foundForm->getServiceId())) {
            /** @var ServiceEntity */
            $foundService = $this->servicesModel->where("id", $foundForm->getServiceId())->first();
            $formsData['service'] = $foundService->getName();
        }

        $crypto = new Crypto();
        foreach ($foundAllFillsByPackage as $field) {
            $fieldListRef = \array_values(array_filter($fields, fn($ref) => $ref->id == $field->getFieldId()));

            if (!isset($fieldListRef[0]))
                continue;

            $fieldRef = $fieldListRef[0];

            $value = $crypto->decrypt($field->getValue(), $field->getPackage() . getenv('system.encrypted_key'));

            if ($fieldRef->element === "birthdate") {
                array_push($formsData['fields'], [
                    "name" => lang("Words.years_old"),
                    "value" => getYearsOldByDate($value),
                ]);
            }

            switch ($fieldRef->element) {
                case "file":
                    array_push($formsData['files'], [
                        "name" => $fieldRef->label,
                        "value" =>  $this->fixProblemWithUrlFiles($value),
                    ]);
                    break;
                case "gallery":
                    $files = \json_decode($value);

                    $listFiles =  \array_map(fn($file) =>  [
                        "name" => $fieldRef->label,
                        "value" => $this->fixProblemWithUrlFiles($file),
                    ], $files);
                    $formsData['files'] = count($formsData['files']) > 0 ? [...$formsData['files'], ...$listFiles] : $listFiles;
                    break;
                default:
                    array_push($formsData['fields'], [
                        "name" => $fieldRef->label,
                        "value" => $fieldRef->element === "phone" ? formatPhoneToText($value) : $value,
                    ]);
                    break;
            }
        }

        if (\count($formsData['fields']) == 0)
            throw new Exceptions("Api.clients.invalid.not_found", NO_CONTENT);

        return $formsData;
    }
}
