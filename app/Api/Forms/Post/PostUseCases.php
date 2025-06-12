<?php

namespace App\Api\Forms\Post;

use App\Business\CustomForms\FileFormFillBusiness;
use App\Database\Entities\CustomForms\CustomFormEntity;
use App\Database\Entities\CustomForms\FormFillEntity;
use App\Database\Models\CustomForms\CustomFormsModel;
use App\Database\Models\CustomForms\FormFillsModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\CustomForms\CustomFormsDataTrait;

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
        helper("crypto");
        if ($payload['g-recaptcha-response'] != \getenv('globals.recaptcha.tokenTest') & !validateRecaptcha($payload['g-recaptcha-response']))
            throw new Exceptions("Api.invalid.recaptcha", BAD_REQUEST);

        unset($payload['g-recaptcha-response']);
        $files = $payload['files'];
        $payload = array_merge($files, $payload);
        unset($payload['files']);

        if (!isset($payload['form_id']))
            throw new Exceptions("Api.custom_forms.invalid.not_found", \NOT_FOUND);

        $customFormModel = new CustomFormsModel();

        /** @var CustomFormEntity */
        $found = $customFormModel->where('id', $payload['form_id'])->first();

        if (empty($found))
            throw new Exceptions("Api.custom_forms.invalid.not_found", \NOT_FOUND);

        $fields = \json_decode($found->getComponents());

        $formsFill = new FormFillsModel();
        $crypto = new Crypto();
        $package = \referenceHash(date("YYYY-MM-DD H:i:s"));

        foreach ($payload as $name => $value) {
            $id = \str_replace("input_", "", $name);
            $possibleFields = \array_values(array_filter($fields, fn($field) => $field->id === $id));
            $formFillEntity = new FormFillEntity();

            if (\count($possibleFields) == 0)
                continue;

            $currentField = $possibleFields[0];

            if (!isset($currentField->element))
                continue;

            $formFillEntity->setFieldId($id);
            $formFillEntity->setPackage($package);
            $formFillEntity->setFormId($payload['form_id']);

            if ($currentField->element == "file")
                $value = FileFormFillBusiness::upload($value);

            $valueEncrypted = $crypto->encrypt($value, "$package" . getenv('system.encrypted_key'));
            $formFillEntity->setValue($valueEncrypted);

            $formsFill->save($formFillEntity);
        }

        return (object)[
            "success" => "Api.custom_forms.success.post"
        ];
    }
}
