<?php

namespace App\Api\Services\Get;

use App\Database\Entities\Services\ServiceEntity;
use App\Database\Models\Services\ServicesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\Services\ServicesDataTrait;

class GetUseCases
{
    use ServicesDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     name: string, 
     *     description_contains: string, 
     *     status: 'ACTIVE' | 'INACTIVE', 
     *     created_at: string, 
     *     updated_at: string 
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $servicesModel = new ServicesModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        if (count($in_ids) > 0)
            $servicesModel->whereIn("id", $in_ids);

        $servicesModel = $this->builderClauseWithContains($payload, $servicesModel);

        $services = $servicesModel->where($filteredPayload)->findAll();

        if (!empty($payload['id']) && count($services) > 0)
            return $this->builder($services[0]);
        else if (!empty($payload['id']) && \count($services) == 0)
            throw new Exceptions("Api.services.invalid.not_found", \NOT_FOUND);

        $servicesData = array_map(
            fn(ServiceEntity $service) => $this->builder($service),
            $services
        );

        return \array_values($servicesData);
    }
}
