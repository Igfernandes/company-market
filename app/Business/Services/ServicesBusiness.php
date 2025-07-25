<?php

namespace App\Business\Services;

use App\Business\BaseBusiness;
use App\Business\Clients\ClientsBusiness;
use App\Database\Entities\Services\ClientServiceEntity;
use App\Database\Entities\Services\ServiceEntity;
use App\Database\Models\Services\ClientsServicesModel;
use App\Database\Models\Services\ServicesModel;
use PhpParser\Node\Expr\Cast\Array_;

class ServicesBusiness
{
    use BaseBusiness;

    private ServicesModel $serviceModel;

    public function __construct()
    {
        $this->serviceModel = new ServicesModel();
    }

    public function hasService($query): bool
    {
        $foundUsers = $this->serviceModel->where($query)->first();

        return !empty($foundUsers);
    }

    public function getAvailableService($query): null|ServiceEntity
    {
        $foundUsers = $this->serviceModel->where($query)->where([
            "status" => "ACTIVE"
        ])->first();

        return $foundUsers;
    }

    /**
     * 
     * @param array{
     *      client_ids:array{int},
     *      service_id:int
     * } $props
     * 
     * @return false|array{
     *      inscribes: array{int},
     *      excludes: array{int},
     *      service: ServiceEntity
     * }
     */
    public function inscribe(array $props)
    {
        $service = $this->getAvailableService([
            "id" => $props['service_id']
        ]);
        if (empty($service))
            return false;

        $clientsBusiness = new ClientsBusiness();

        if (!$clientsBusiness->hasClients($props['client_ids']))
            return false;

        $clientsServicesModel = new ClientsServicesModel();
        $clientService = new ClientServiceEntity();

        $founds = $clientsServicesModel->where("service_id", $props['service_id'])->findAll();
        $clientsIdsRegistered = \array_map(fn(ClientServiceEntity $clientService) => $clientService->getClientId(), $founds);
        $clientsServiceData = [];

        foreach ($props['client_ids'] as $clientId) {
            if (\array_search($clientId, $clientsIdsRegistered) !== false)
                continue;

            \array_push($clientsServiceData, [
                "client_id" => $clientId,
                "service_id" => $props['service_id']
            ]);
        }

        $clientsExcluded = \array_filter($clientsIdsRegistered, fn(int $clientRegisteredId) => \array_search($clientRegisteredId, $props['client_ids']) === false);

        if (\count($clientsExcluded) > 0)
            $clientsServicesModel->whereIn("client_id", $clientsExcluded)->delete();
        if (\count($clientsServiceData) > 0)
            $clientsServicesModel->insertBatch($clientsServiceData);

        return [
            "inscribes" => $props['client_ids'],
            "excludes" => $clientsExcluded,
            "service" => $service
        ];
    }
}
