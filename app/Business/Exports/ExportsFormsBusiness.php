<?php

namespace App\Business\Exports;

use App\Business\BaseBusiness;
use App\Database\Entities\CustomForms\CustomFormEntity;
use App\Database\Entities\CustomForms\FormFillEntity;
use App\Database\Models\CustomForms\CustomFormsModel;
use App\Database\Models\CustomForms\FormFillsModel;
use App\Libraries\Crypto\Crypto;

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

    /** 
     * @param array{int} $formIds
     */
    public function getData(array $formIds): array
    {
        helper(['dates']);
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

            if (!isset($formsData[$field->getPackage()]))
                $formsData[$field->getPackage()] = [];

            $value = $crypto->decrypt($field->getValue(), $field->getPackage() . getenv('system.encrypted_key'));

            if ($fieldRef[0]->element === "birthdate") {
                array_push($formsData[$field->getPackage()], [
                    "name" => lang("Words.years_old"),
                    "value" => getYearsOldByDate($value),
                ]);
            }

            array_push($formsData[$field->getPackage()], [
                "name" => $fieldRef[0]->label,
                "value" => $value,
            ]);
        }

        return [
            "title" => $foundForm->getName(),
            "form" => \array_values($formsData)
        ];
    }
}
