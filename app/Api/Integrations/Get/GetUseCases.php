<?php

namespace App\Api\Integrations\Get;

use App\Database\Entities\Integrations\IntegrationEntity;
use App\Database\Models\Integrations\IntegrationsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\Integrations\IntegrationDataTrait;

class GetUseCases
{
    use IntegrationDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     provider: string,
     *     type: string,
     *     created_at: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $integrationModel = new IntegrationsModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        if (count($in_ids) > 0)
            $integrationModel->whereIn("id", $in_ids);

        $banks = $integrationModel->where($filteredPayload)->findAll();

        if (!empty($payload['id']) && count($banks) > 0)
            return $this->builder($banks[0]);
        else if (!empty($payload['id']) && \count($banks) == 0)
            throw new Exceptions(lang("Errors.not_found"), \NOT_FOUND);

        $banksData = array_map(
            fn(IntegrationEntity $integration) => $this->builder($integration),
            $banks
        );

        return \array_values($banksData);
    }
}
