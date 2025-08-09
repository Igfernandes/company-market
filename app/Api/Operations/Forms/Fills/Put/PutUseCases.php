<?php

namespace App\Api\Operations\Forms\Fills\Put;

use App\Business\CustomForms\FormFillBusiness;
use App\Business\Fields\FieldsComponentsBusiness;
use App\Database\Entities\CustomForms\CustomFormEntity;
use App\Database\Entities\CustomForms\FormFillEntity;
use App\Database\Entities\Fields\FieldEntity;
use App\Database\Models\CustomForms\CustomFormsModel;
use App\Database\Models\CustomForms\FormFillsModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\CustomForms\CustomFormsDataTrait;

class PutUseCases
{
    use CustomFormsDataTrait, BusinessTrait;

    /**
     * @param array{
     *  fields: array{string},
     *  package: string,
     *  formId: integer,   
     * } $payload
     */
    public function execute(array $payload)
    {
        $response =  (object)[
            "success" => "Api.custom_forms.success.post"
        ];
        helper(["crypto", "array"]);
        $fields = (array) $payload['fields'];
        if (!is_array($fields))
            throw new Exceptions("Api.forms.invalid.fields", \BAD_REQUEST);

        if (\count($fields) == 0)
            return $response;

        $customFormModel = new CustomFormsModel();

        /** @var CustomFormEntity */
        $foundForm = $customFormModel->where('id', $payload['formId'])->first();

        if (empty($foundForm))
            throw new Exceptions("Api.custom_forms.invalid.not_found", \NOT_FOUND);

        $formFillsModel = new FormFillsModel();
        $crypto = new Crypto();

        $foundFields = $formFillsModel->where([
            "form_id" => $payload['formId'],
            "package" => $payload['package']
        ])->whereIn("field_id", \array_map(fn($name) => \str_replace("input_", "", $name), \array_keys($fields)))->findAll();

        $fieldsData = [];
        /** @var array{FieldEntity} */
        $components = \json_decode($foundForm->getComponents());

        foreach ($fields as $name => $value) {
            $id = \str_replace("input_", "", $name);

            if (FormFillBusiness::isComponent($components, $id, "gallery")) {
                $value = FieldsComponentsBusiness::gallery($value);
            }
            if (strstr($value, "{") && FormFillBusiness::isComponent($components, $id, "file")) {

                $value = FieldsComponentsBusiness::file($value);
            }

            $data = [
                "field_id" => $id,
                "package" => $payload['package'],
                "form_id" => $payload['formId'],
                "value" =>  $crypto->encrypt($value, $payload['package'] . getenv('system.encrypted_key'))
            ];
            $foundFillField = \array_values(\array_filter($foundFields, fn(FormFillEntity $field) => $field->getFieldId() == $id));

            if (!isset($foundFillField[0])) {
                $field = FormFillBusiness::store([
                    "name" => $name,
                    "value" => $value,
                    "package" => $payload['package'],
                    "form_id" => $payload['formId']
                ], $components);

                if (empty($field)) continue;

                $formFillsModel->save($field);
                continue;
            }

            $data['id'] = $foundFillField[0]->getId();
            $fieldsData['update'][] = $data;
        }

        if (isset($fieldsData['update']) && \count($fieldsData['update']) > 0)
            $formFillsModel->updateBatch($fieldsData['update'], "id");


        return $response;
    }
}
