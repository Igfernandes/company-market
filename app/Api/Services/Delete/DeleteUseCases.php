<?php

namespace App\Api\Services\Delete;

use App\Business\Services\ServicesBusiness;
use App\Database\Models\Services\ServicesModel;
use App\Libraries\Exceptions\Exceptions;

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
            throw new Exceptions(\str_replace("{field}", lang("Words.service"), lang("Validation.not_found")), \BAD_BUSINESS_RULES);

        $servicesModel = new ServicesModel();

        $servicesModel->delete($serviceId);

        return (object)[
            "success" => lang("Api.services.success.delete")
        ];
    }
}
