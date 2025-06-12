<?php

namespace App\Api\Services\Delete;

use App\Business\Services\ServicesBusiness;
use App\Database\Models\Services\ServicesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;

class DeleteUseCases
{
    /**
     * @param array{
     *   id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $servicesBusiness = new ServicesBusiness();

        $serviceId = $payload['id'];

        if (!$servicesBusiness->hasService([
            "id" => $serviceId
        ]))
            throw new Exceptions("Api.services.invalid.not_found", \BAD_BUSINESS_RULES);

        $servicesModel = new ServicesModel();

        $servicesModel->delete($serviceId);

        NotificationsService::store([
            "scope" => "services",
            "action" => "DELETE"
        ]);
        return (object)[
            "success" => "Api.services.success.delete"
        ];
    }
}
