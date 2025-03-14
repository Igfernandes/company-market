<?php

namespace App\Api\Clients\Get;

use App\Database\Entities\Clients\CategoryEntity;
use App\Database\Entities\clients\ClientCategoryEntity;
use App\Database\Entities\Clients\ClientEntity;
use App\Database\Migrations\Clients;
use App\Database\Migrations\ClientsCategories;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use App\Traits\Clients\ClientsDataTrait;

class GetUseCases
{
    use ClientsDataTrait;

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

        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $clientsModel = new ClientsModel();
        $clientsCategoriesModel = new ClientsCategoriesModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        $userAuthId = $session->get('userAuthId');

        if (count($in_ids) > 0)
            $clientsModel->whereIn("id", $in_ids);

        $filteredPayload['owner_id'] = $userAuthId;

        $foundClientsCategory = $clientsCategoriesModel->getClientsWithCategory($filteredPayload);
        $clients = [];

        foreach ($foundClientsCategory as $clientCategory) {
            $clients[$clientCategory->getClientId()] = $clientCategory->getClient();
        }

        $clientsData = array_map(
            fn(ClientEntity $client) => $this->builder($client, $foundClientsCategory),
            $clients
        );

        return \array_values($clientsData);
    }
}
