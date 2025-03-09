<?php

namespace App\Api\Clients\Get;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Models\Clients\ClientsModel;

class GetUseCases
{
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
        $clientEntity = new ClientEntity();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        $userAuthId = $session->get('userAuthId');

        if (count($in_ids) > 0)
            $clientsModel->whereIn("id", $in_ids);

        $filteredPayload['owner_id'] = $userAuthId;

        $clientEntity->fill($filteredPayload);
        /** @var array{ClientEntity}*/
        $foundClients = $clientsModel->where($filteredPayload)->findAll();

        return array_map(fn(ClientEntity $client) => $client->toArray(true), $foundClients);
    }
}
