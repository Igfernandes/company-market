<?php

namespace App\Api\Finances\Charges\Get;

use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Models\Finances\ChargesClientsModel;
use App\Database\Models\Finances\ChargesModel;
use App\Database\Models\Services\ServicesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\Charges\ChargesDataTrait;

class GetUseCases
{
    use ChargesDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     title: string,
     *     description: string,
     *     service_id: string, 
     *     type: 'APPELLANT'|'PUNCTUAL',
     *     price: string, 
     *     promotional_price: string, 
     *     clients: array{integer}
     *     created_at: string, 
     *     updated_at: string 
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $chargesModel = new ChargesModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        if (count($in_ids) > 0)
            $chargesModel->whereIn("id", $in_ids);

        $chargesModel = $this->builderClauseWithContains($payload, $chargesModel);

        $charges = $chargesModel->where($filteredPayload)->findAll();

        if (\count($charges) == 0) return [];

        if (!empty($payload['id']) && count($charges) > 0)
            return $this->builder($charges[0]);
        else if (!empty($payload['id']) && \count($charges) == 0)
            throw new Exceptions(lang("Errors.not_found"), \NOT_FOUND);

        $servicesModel = new ServicesModel();
        $foundServices = $servicesModel
            ->whereIn("id", \array_map(fn(ChargeEntity $charge) => $charge->getId(), $charges))->findAll();
        $chargesClientsModel = new ChargesClientsModel();
        $foundChargesClients = $chargesClientsModel
            ->select("charges_clients.*, clients.name as client_name, clients.id as client_id")
            ->join("clients", "clients.id = charges_clients.client_id")
            ->whereIn("charge_id", \array_map(fn(ChargeEntity $charge) => $charge->getId(), $charges))->findAll();

        $chargesData = array_map(
            fn(ChargeEntity $charge) => $this->builder($charge, $foundServices, $foundChargesClients),
            $charges
        );

        return \array_values($chargesData);
    }
}
