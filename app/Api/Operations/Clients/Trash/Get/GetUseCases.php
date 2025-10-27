<?php

namespace App\Api\Operations\Clients\Trash\Get;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Models\Clients\ClientsModel;
use App\Traits\Clients\ClientsDataTrait;

class GetUseCases
{
    use ClientsDataTrait;

    /**
     * @param array{
     *     id?: int,
     *     in_ids?: array<int>, 
     *     status?: 'AVAILABLE'|'MAINTENANCE'|'UNAVAILABLE', 
     *     phone?: string, 
     *     limit: integer|undefined;
     *     start: integer|undefined;
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredFields = \array_filter($payload, fn($field) => !empty($field));

        $clientEntity = new ClientEntity();
        $clientEntity->store($filteredFields);

        if (isset($payload['id'])) {
            $clientEntity->setId($payload['id']);
        }

        $limit = isset($payload['limit']) ? \intval($payload['limit']) : 50;
        $startIndexRegister = isset($payload['start']) ? \intval($payload['start']) : 0;

        $clientsModel = new ClientsModel();
        $foundDeleted = $clientsModel->withDeleted(true)->limit($limit, $startIndexRegister)->onlyDeleted()->findAll();

        if (\count($foundDeleted) == 0)
            return [];

        if (isset($filteredFields['id']))
            return $this->clientWithCategories($foundDeleted[0]);

        return array_map(fn(ClientEntity $client) => $this->clientWithCategories($client), $foundDeleted);
    }
}
