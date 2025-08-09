<?php

namespace App\Api\Operations\Clients\Services\Patch\IsConfirm;

use App\Business\Clients\ClientsBusiness;
use App\Database\Models\Services\ClientsServicesModel;
use App\Database\Models\Services\ServicesModel;
use App\Interfaces\IUseCases;
use App\Libraries\Exceptions\Exceptions;

class PatchIsConfirmUseCases implements IUseCases
{
    /**
     * @param array{
     *   service_id: integer,
     *   client_id: integer
     * } $payload
     */
    public function execute(array $payload): object
    {
        $clientsBusiness = new ClientsBusiness();

        if (!$clientsBusiness->hasClient($payload['client_id']))
            throw new Exceptions("Api.clients.invalid.id", \BAD_REQUEST);

        $servicesModel = new ServicesModel();
        $service = $servicesModel->where("id", $payload['service_id'])->first();

        if (empty($service) || $service->getStatus() === "INACTIVE")
            throw new Exceptions("Api.clients.services.invalid.status");

        $clientsServicesModel = new ClientsServicesModel();

        $clientsServicesModel->where($payload)->set([
            "is_confirm" => true
        ])->update();

        return (object)[
            "success" => "Api.clients.services.isConfirm.success"
        ];
    }
}
