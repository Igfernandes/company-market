<?php

namespace App\Api\Operations\Clients\Get;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use App\Traits\BusinessTrait;
use App\Traits\Clients\ClientsDataTrait;

class GetUseCases
{
    use ClientsDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     name: string, 
     *     phone: string, 
     *     birthdate: string, 
     *     status: 'ACTIVE' | 'INACTIVE', 
     *     created_at: string, 
     *     updated_at: string,
     *     limit: integer|undefined,
     *     start: integer|undefined
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = array_filter($payload, fn($field) => !empty($field));

        $clientsModel = new ClientsModel();
        $clientsCategoriesModel = new ClientsCategoriesModel();

        $clientEntity = new ClientEntity();
        $clientEntity->store($payload);

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        if (isset($filteredPayload['phone'])) {
            $filteredPayload['phone_sha256'] = referenceHash($filteredPayload['phone']);
            unset($filteredPayload['phone']);
        }

        $clientsModel->where($clientEntity->toArray(true));
        if (count($in_ids) > 0)
            $clientsModel->whereIn("id", $in_ids);

        $clientsModel = $this->builderClauseWithContains($filteredPayload, $clientsModel);

        $foundClientsCategory = $clientsCategoriesModel->getClientsWithCategory($clientEntity->toArray(true));

        $limit = isset($payload['limit']) ? \intval($payload['limit']) : 50;
        $startIndexRegister = isset($payload['start']) ? \intval($payload['start']) : 0;

        $foundClients = $clientsModel->limit($limit, $startIndexRegister)->findAll();

        return array_map(
            fn(ClientEntity $client) => $this->clientWithCategories($client, $foundClientsCategory),
            $foundClients
        );
    }
}
