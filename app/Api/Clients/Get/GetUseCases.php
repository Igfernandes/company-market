<?php

namespace App\Api\Clients\Get;

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
     *     updated_at: string 
     * } $payload
     */
    public function execute(array $payload)
    {
        $session = session();
        $userAuthId = $session->get('userAuthId');

        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $clientsModel = new ClientsModel();
        $clientsCategoriesModel = new ClientsCategoriesModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        if (isset($filteredPayload['phone'])) {
            $filteredPayload['phone_sha256'] = referenceHash($filteredPayload['phone']);
            unset($filteredPayload['phone']);
        }

        $clientsModel->where($filteredPayload);
        if (count($in_ids) > 0)
            $clientsModel->whereIn("id", $in_ids);

        $clientsModel = $this->builderClauseWithContains($filteredPayload, $clientsModel);
        $foundClientsCategory = $clientsCategoriesModel->getClientsWithCategory($filteredPayload);

        $foundClients = $clientsModel->findAll();

        $clientsData = array_map(
            fn(ClientEntity $client) => $this->clientWithCategories($client, $foundClientsCategory),
            $foundClients
        );

        return \array_values($clientsData);
    }
}
