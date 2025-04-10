<?php

namespace App\Api\Integrations\Banks\Get;

use App\Database\Entities\Integrations\IntegrationBankEntity;
use App\Database\Models\Integrations\IntegrationBanksModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\Integrations\IntegrationBanksDataTrait;

class GetUseCases
{
    use IntegrationBanksDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     type: "MERCADO_PAGO",
     *     created_at: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $integrationBanksModel = new IntegrationBanksModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        if (count($in_ids) > 0)
            $integrationBanksModel->whereIn("id", $in_ids);

        $banks = $integrationBanksModel->where($filteredPayload)->findAll();

        if (!empty($payload['id']) && count($banks) > 0)
            return $this->builder($banks[0]);
        else if (!empty($payload['id']) && \count($banks) == 0)
            throw new Exceptions(lang("Errors.not_found"), \NOT_FOUND);

        $banksData = array_map(
            fn(IntegrationBankEntity $integrationBank) => $this->builder($integrationBank),
            $banks
        );

        return \array_values($banksData);
    }
}
