<?php

namespace App\Api\Operations\Clients\Services\Get;

use App\Business\Permissions\PermissionsBusiness;
use App\Database\Entities\Services\ClientServiceEntity;
use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Services\ClientsServicesModel;
use App\Traits\BusinessTrait;
use App\Traits\Clients\ClientsServiceDataTrait;

class GetUseCases
{
    use ClientsServiceDataTrait, BusinessTrait;

    /**
     * @param array{
     *     service_id: int,
     * } $payload
     */
    public function execute(array $payload)
    {
        $session = session();
        $userAuthId = $session->get('userAuthId');
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $clientsServicesModel = new ClientsServicesModel();

        $hasPermissionToView = PermissionsBusiness::hasPermissionUser("services", "VIEW", $userAuthId);

        if (!$hasPermissionToView)
            return [];

        $serviceId = $filteredPayload['service_id'];
        unset($filteredPayload['service_id']);

        $clientsCategoriesModel = new ClientsCategoriesModel();
        $foundClientsServices = $clientsServicesModel->getClientsWithServices([], [
            "id" => $serviceId
        ]);

        $queryClient = [];

        if (\count($foundClientsServices) > 0)
            $queryClient["in_ids"] =  array_map(fn(ClientServiceEntity $clientService) => $clientService->getClientId(), $foundClientsServices);

        $foundClientsCategory = $clientsCategoriesModel->getClientsWithCategory($queryClient);

        $clientsData = array_map(
            fn(ClientServiceEntity $clientService) => $this->clientWithServices($clientService, $foundClientsCategory),
            $foundClientsServices
        );

        return \array_values($clientsData);
    }
}
