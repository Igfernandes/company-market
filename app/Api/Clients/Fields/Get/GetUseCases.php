<?php

namespace App\Api\Clients\Fields\Get;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Entities\Fields\ClientFieldEntity;
use App\Database\Entities\Fields\FieldEntity;
use App\Database\Models\Fields\ClientsFieldsModel;
use App\Database\Models\Fields\FieldsModel;
use App\Traits\BusinessTrait;
use App\Traits\Fields\FieldsDataTrait;

class GetUseCases
{
    use FieldsDataTrait, BusinessTrait;

    /**
     * @param array{
     *  id: int|null,
     *  name: string|null,
     *  name_contains: string|null,
     *  component: "INPUT"|"SELECT"|"TEXTAREA"|null,
     *  type: string|null,
     *  scope: "USER"|"CLIENT"|"COMPANY"|null,
     *  is_file: boolean|null,
     *  is_required: boolean|null,
     *  is_sensitive: boolean|null,
     *  group_id: integer|null,
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        if (isset($filteredPayload['id'])) {
            $clientId = $filteredPayload['id'];
            unset($filteredPayload['id']);
        }

        $clientWhere = isset($clientId) ? [
            "id" => $clientId
        ] : [];

        $clientsFieldsModel = new ClientsFieldsModel();
        $fieldsModel = new FieldsModel();

        $foundClientsFields = $clientsFieldsModel->getClientsWithFields($clientWhere, $filteredPayload);
        $payloadWithFieldsPrefix = $fieldsModel->addPrefixInQuery($filteredPayload, "fields");
        if (\count($payloadWithFieldsPrefix) > 0)
            $fieldsModel->where($payloadWithFieldsPrefix);

        $foundFields = $fieldsModel->select("fields.*")->like("scope", "CLIENT")->join("fields_groups", "fields_groups.id = fields.group_id")->findAll();

        $fieldsData = array_map(
            fn(FieldEntity $field) => $this->fieldWithClients($field, $foundClientsFields),
            $foundFields
        );

        return \array_values($fieldsData);
    }
}
