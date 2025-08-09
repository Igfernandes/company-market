<?php

namespace App\Api\Operations\Clients\Fields\Post;

use App\Business\Clients\ClientsBusiness;
use App\Business\Fields\FieldsBusiness;
use App\Business\Fields\FieldsFilesBusiness;
use App\Database\Entities\Fields\ClientFieldEntity;
use App\Database\Models\Fields\ClientsFieldsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;

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
            throw new Exceptions("Api.clients.fields.invalid.id", BAD_BUSINESS_RULES);

        if (!$ClientsBusiness->hasClient($payload['client']))
            throw new Exceptions("Api.clients.fields.invalid.client_id", BAD_BUSINESS_RULES);

        $clientsFieldsModel = new ClientsFieldsModel();

        foreach ($payload['fields'] as $index => $field):
            $field['data'] = isset($files[$index]['value']) ? $files[$index]['value'] : $field;

            if (empty($field['data']) || $field['data'] == "undefined")
                continue;

            $clientField = new ClientFieldEntity();

            $clientField->setClientId($payload['client']);
            $clientField->setFieldId($field['id']);

            $where = $clientField->toArray(true);

            if (isset($files[$index])) {
                FieldsFilesBusiness::validateFileSize($field['data']);
                $clientField->setValue(FieldsFilesBusiness::upload($field['data']));
            } else $clientField->setValue($field['data']['value']);

            $clientsFieldsModel->upsert($where, $clientField);
        endforeach;

        NotificationsService::store([
            "scope" => "fields",
            "action" => "CREATE"
        ]);
        return [
            "success" => "Api.clients.fields.success.post"
        ];
    }
}
