<?php

namespace App\Api\Clients\Fields\Post;

use App\Business\Clients\ClientsBusiness;
use App\Business\Fields\FieldsBusiness;
use App\Database\Entities\Fields\ClientFieldEntity;
use App\Database\Models\Fields\ClientsFieldsModel;
use App\Libraries\Exceptions\Exceptions;

class PostUseCases
{
    /**
     * @param array{
     *  client: integer,
     *  fields: array{object{
     *      id: integer,
     *      value: string
     * }}
     * } $payload
     * @param array{}
     */
    public function execute(array $payload, array $files)
    {
        $payload['fields'] = \is_array($payload['fields']) ? $payload['fields'] : json_decode($payload['fields']);

        $fieldBusiness = new FieldsBusiness();
        $ClientsBusiness = new ClientsBusiness();

        if (!$fieldBusiness->hasField(\array_map(function ($field) {

            return $field['id'];
        }, $payload['fields'])))
            throw new Exceptions(lang("Api.fields.invalid.id"), BAD_BUSINESS_RULES);

        if (!$ClientsBusiness->hasClient($payload['client']))
            throw new Exceptions(lang("Api.clients.fields.invalid.client_id"), BAD_BUSINESS_RULES);

        $clientsFieldsModel = new ClientsFieldsModel();

        foreach ($payload['fields'] as $index => $fields):
            if (empty($fields['value']) || $fields['value'] == "undefined")
                continue;

            $clientField = new ClientFieldEntity();

            $clientField->setClientId($payload['client']);
            $clientField->setFieldId($fields['id']);

            $where = $clientField->toArray(true);

            if (isset($files[$index]) && isset($files[$index]['value']))
                $clientField->setValue($fieldBusiness->upload($files[$index]['value']));
            else $clientField->setValue($fields['value']);

            $clientsFieldsModel->upsert($where, $clientField);
        endforeach;

        return [
            "success" => "Api.clients.fields.success.post"
        ];
    }
}
