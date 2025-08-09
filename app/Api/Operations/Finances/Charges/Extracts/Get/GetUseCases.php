<?php

namespace App\Api\Operations\Finances\Charges\Extracts\Get;

use App\Business\Charges\ChargesBusiness;
use App\Business\WebHooks\MercadoPagoBusiness;
use App\Database\Entities\Finances\PaymentEntity;
use App\Database\Models\Finances\PaymentsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;

class GetUseCases
{
    use BusinessTrait;

    /**
     * @param array{
     *     id: int,
     *     payment_id: int,
     * } $payload
     */
    public function execute(array $payload)
    {
        $chargesBusiness = new ChargesBusiness();
        $mercadoPagoBusiness = new MercadoPagoBusiness();

        if (!$chargesBusiness->hasCharge($payload['id']) == false)
            throw new Exceptions("Api.charges.extracts.not_found", BAD_REQUEST);

        $paymentsModel = new PaymentsModel();

        /** @var PaymentEntity */
        $payment = $paymentsModel->where(
            [
                'id' =>  $payload['payment_id'],
                'charge_id' => $payload['id']
            ]
        )->first();
        if (empty($payment))
            throw new Exceptions("Api.charges.extracts.not_found", BAD_REQUEST);

        $mercadoPago = $mercadoPagoBusiness->getInstance();

        $extract = $mercadoPago->getPayment($payment->getPaymentId());

        return  $extract->getAttributes();
    }
}
