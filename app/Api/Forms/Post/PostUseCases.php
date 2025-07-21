<?php

namespace App\Api\Forms\Post;

use App\Business\CustomForms\FormFillBusiness;
use App\Database\Entities\CustomForms\CustomFormEntity;
use App\Database\Models\CustomForms\CustomFormsModel;
use App\Database\Models\CustomForms\FormFillsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\CustomForms\CustomFormsDataTrait;
use DateTime;

class PostUseCases
{
    use CustomFormsDataTrait, BusinessTrait;

    /**
     * @param array{
     *  x: string,
     *  form_id: integer,   
     *  g-recaptcha-response: string,
     *  files: array
     * } $payload
     */
    public function execute(array $payload)
    {
        helper(["crypto", "array"]);

        if (!isset($payload['form_id']))
            throw new Exceptions("Api.custom_forms.invalid.not_found", \NOT_FOUND);

        $customFormModel = new CustomFormsModel();

        /** @var CustomFormEntity */
        $found = $customFormModel->where('id', $payload['form_id'])->first();

        if (empty($found))
            throw new Exceptions("Api.custom_forms.invalid.not_found", \NOT_FOUND);

        $components = \json_decode($found->getComponents());

        $formsFillsModel = new FormFillsModel();
        $package = \referenceHash(date("YYYY-MM-DD H:i:s"));

        $clientData = [];

        foreach ($payload as $name => $value) {
            $field = FormFillBusiness::store([
                "name" => $name,
                "value" => $value,
                "package" => $package,
                "form_id" => $payload['form_id']
            ], $components);

            if (empty($field))
                continue;

            $id = \str_replace("input_", "", $name);
            $component = FormFillBusiness::getComponent($id, $components);

            if (\array_search($component->element, ['email', 'phone', 'birthdate', 'name']) !== false)
                $clientData[$component->element] = $value;

            $formsFillsModel->save($field);
        }

        if (isValidIndexInArray("phone", $clientData)  && isValidIndexInArray("name", $clientData)) {
            FormFillBusiness::clientCreate($clientData, $payload['form_id'], $package);
        }

        return (object)[
            "success" => "Api.custom_forms.success.post"
        ];
    }
}
