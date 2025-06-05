<?php

namespace App\Traits\Payments;

use App\Database\Entities\Finances\PaymentEntity;

trait PaymentDataTrait
{
    public function builder(PaymentEntity $paymentEntity): Object
    {
        return  (object)[
            "id" => $paymentEntity->getId(),
            "payment_id" => $paymentEntity->getPaymentId(),
            "charge_id" => $paymentEntity->getChargeId(),
            "client_id" => $paymentEntity->getClientId(),
            "bank_id" => $paymentEntity->getBankId(),
            "status" => $paymentEntity->getStatus(),
            "paid_amount" => $paymentEntity->getPaidAmount(),
            "created_at" => $paymentEntity->getCreatedAt(),
            "updated_at" => $paymentEntity->getUpdatedAt()
        ];
    }
}
