<?php

namespace App\Api\Forms\Post;

use App\Business\Clients\ClientsBusiness;
use App\Business\CustomForms\FileFormFillBusiness;
use App\Database\Entities\CustomForms\ClientFormHistoryEntity;
use App\Database\Entities\CustomForms\CustomFormEntity;
use App\Database\Entities\CustomForms\FormFillEntity;
use App\Database\Entities\Fields\FieldEntity;
use App\Database\Models\CustomForms\ClientsFormsHistoryModel;
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
        if (!isset($payload['recaptcha']) || !validateRecaptcha([
            "token" => $payload['recaptcha']
        ]))
            throw new Exceptions("Api.auth.invalid.recaptcha", BAD_REQUEST);

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

        $clientData = [];

        foreach ($payload as $name => $value) {
            $id = \str_replace("input_", "", $name);
            $possibleFields = \array_values(array_filter($fields, fn($field) => $field->id === $id));
            $formFillEntity = new FormFillEntity();

            if (\count($possibleFields) == 0)
                continue;

            /** @var FieldEntity */
            $currentField = $possibleFields[0];

            if (!isset($currentField->element))
                continue;

            if (\array_search($currentField->element, ['email', 'phone', 'birthdate', 'name']) !== false)
                $clientData[$currentField->element] = $value;

            $formFillEntity->setFieldId($id);
            $formFillEntity->setPackage($package);
            $formFillEntity->setFormId($payload['form_id']);

            if ($currentField->element == "file")
                $value = FileFormFillBusiness::upload($value);

            $valueEncrypted = $crypto->encrypt($value, "$package" . getenv('system.encrypted_key'));
            $formFillEntity->setValue($valueEncrypted);

            $formsFill->save($formFillEntity);
        }

        if (isset($clientData['phone']) && isset($clientData['name'])) {
            $clientBusiness = new ClientsBusiness();
            $clientId = $clientBusiness->store($clientData);

            $clientsFormsHistory = new ClientsFormsHistoryModel();
            $clientFormHistoryEntity = new ClientFormHistoryEntity();

            $clientFormHistoryEntity->setClientId($clientId);
            $clientFormHistoryEntity->setFormId($payload['form_id']);
            $clientFormHistoryEntity->setPackage($package);
            
            $clientsFormsHistory->save($clientFormHistoryEntity);
        }

        return (object)[
            "success" => "Api.custom_forms.success.post"
        ];
    }
}
