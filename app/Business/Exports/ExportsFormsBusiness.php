<?php

namespace App\Business\Exports;

use App\Business\BaseBusiness;
use App\Database\Entities\CustomForms\CustomFormEntity;
use App\Database\Entities\CustomForms\FormFillEntity;
use App\Database\Models\CustomForms\CustomFormsModel;
use App\Database\Models\CustomForms\FormFillsModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use DateTime;

class ExportsFormsBusiness
{
    use BaseBusiness;

    private FormFillsModel $formFillsModel;
    private CustomFormsModel $customForms;

    public function __construct()
    {
        $this->customForms = new CustomFormsModel();
        $this->formFillsModel = new FormFillsModel();
    }

    public function fixProblemWithUrlFiles(string $url)
    {
        $updatedUrl = \str_replace(["/"], "\\", $url);
        $paths = explode("\writable\\", preg_replace('/\\f/', '/f', $updatedUrl));

        if (count($paths) == 2)
            return WRITEPATH . $paths[1];
        else return $url;
    }

    /** 
     * @param array{int} $formIds
     */
    public function getData(array $formIds): array
    {
        helper(['dates', 'string', 'files']);
        /** 
         * @var CustomFormEntity
         */
        $foundForm = $this->customForms->where([
            "id" => $formIds[0]
        ])->first();
        /** 
         * @var array{FormFillEntity}
         */
        $foundFills = $this->formFillsModel->where([
            "form_id" => $formIds[0]
        ])->findAll();

        /** @var array{Object} */
        $fields = \json_decode($foundForm->getComponents());
        $formsData = [];

        $crypto = new Crypto();
        foreach ($foundFills as $field) {
            $fieldRef = \array_values(array_filter($fields, fn($ref) => $ref->id == $field->getFieldId()));

            if (!isset($fieldRef[0]))
                continue;
            $fieldRef = $fieldRef[0];

            if (!isset($formsData[$field->getPackage()])) {
                $dataObj = new DateTime($field->getCreatedAt());
                $formsData[$field->getPackage()] = [
                    [
                        "name" => lang("Words.filled_at"),
                        "value"  =>  $dataObj->format('d/m/Y H:i:s')
                    ]

                ];
            }

            $value = $crypto->decrypt($field->getValue(), $field->getPackage() . getenv('system.encrypted_key'));

            if ($fieldRef->element === "birthdate") {
                array_push($formsData[$field->getPackage()], [
                    "name" => lang("Words.years_old"),
                    "value" => getYearsOldByDate($value),
                ]);
            }

            switch ($fieldRef->element) {
                case "file":
                    array_push($formsData[$field->getPackage()], [
                        "name" => $fieldRef->label,
                        "value" =>  getPublicUrl($this->fixProblemWithUrlFiles($value)),
                    ]);
                    break;
                case "gallery":
                    $files = \json_decode($value);

                    array_push($formsData[$field->getPackage()], [
                        "name" => $fieldRef->label,
                        "value" => join(",", array_map(fn($file) => \getPublicUrl($file), $files)),
                    ]);
                    break;
                default:
                    array_push($formsData[$field->getPackage()], [
                        "name" => $fieldRef->label,
                        "value" => $fieldRef->element === "phone" ? formatPhoneToText($value) : $value,
                    ]);
                    break;
            }
        }

        if (\count($formsData) == 0)
            throw new Exceptions("Api.clients.invalid.not_found", NO_CONTENT);

        return [
            "title" => $foundForm->getName(),
            "description" => $foundForm->getDescription(),
            "forms" => \array_values($formsData)
        ];
    }
}
