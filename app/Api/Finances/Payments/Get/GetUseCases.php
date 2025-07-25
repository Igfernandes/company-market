<?php

namespace App\Api\Finances\Payments\Get;

use App\Database\Entities\Finances\PaymentEntity;
use App\Database\Models\Finances\PaymentsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\Payments\PaymentDataTrait;

class GetUseCases
{
    use PaymentDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     payment_id: integer|null,
     *     charge_id: integer|null,
     *     client_id: integer|null,
     *     status: 'PAID'|'PENDENT'|'CANCELED',
     *     created_at: string, 
     *     updated_at: string 
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $paymentsModel = new PaymentsModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        if (count($in_ids) > 0)
            $paymentsModel->whereIn("id", $in_ids);

        $payments = $paymentsModel->where($filteredPayload)->findAll();

        if (\count($payments) == 0) return [];

        if (!empty($payload['id']) && count($payments) > 0)
            return $this->builder($payments[0]);
        else if (!empty($payload['id']) && \count($payments) == 0)
            throw new Exceptions("Api.payments.invalid.not_found", \NOT_FOUND);

        $paymentsData = array_map(
            fn(PaymentEntity $payment) => $this->builder($payment),
            $payments
        );

        return \array_values($paymentsData);
    }
}
