<?php

/**
 * @package Register
 * - Referente ao registro de usuários.
 */

namespace App\Business\WebHooks;

use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Entities\Finances\PaymentEntity;
use App\Database\Models\Clients\ClientsModel;
use App\Database\Models\Finances\ChargesModel;
use App\Database\Models\Finances\PaymentsModel;
use App\Database\Models\Integrations\IntegrationsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\MercadoPago\MercadoPago;

class MercadoPagoBusiness
{
    public array $status = [
        "approved" => "PAID",
        "pending" => "PENDING",
        "in_process" => "PENDING",
        "authorized" => "PAID",
        "rejected" => "CANCELED",
        "refunded" => "CANCELED"
    ];

    public function getInstance(): MercadoPago
    {
        $integrationBankModel = new IntegrationsModel();

        /** @var IntegrationBankEntity */
        $foundBank = $integrationBankModel->where(["provider" => "MERCADO_PAGO"])->first();

        if (empty($foundBank))
            throw new Exceptions(\lang("Api.webhook.mercado_pago"), \BAD_BUSINESS_RULES);

        $mercadoPago = new MercadoPago($foundBank->getDecryptPrivateToken());
        return $mercadoPago;
    }

    /**
     * @param object{
     *   action: string,
     *   api_version: "v1"|"v2",
     *   data: object{
     *     id: int
     *   },
     *   date_created: string,
     *   id: int,
     *   live_mode: bool,
     *   type: string,
     *   user_id: int
     * } $payload
     */
    public function store(object $payload)
    {
        $integrationBankModel = new IntegrationsModel();
        $paymentEntity = new PaymentEntity();

        /** @var IntegrationBankEntity */
        $foundBank = $integrationBankModel->where(["provider" => "MERCADO_PAGO"])->first();
        $paymentId = $payload->data->id;

        $paymentEntity->setPaymentId($paymentId);

        if (empty($foundBank))
            throw new Exceptions("Api.webhooks.mercado_pago", \BAD_BUSINESS_RULES);

        $mercadoPago = new MercadoPago($foundBank->getDecryptPrivateToken());
        $payment = $mercadoPago->getPayment($payload->data->id);

        if (empty($payment))
            throw new Exceptions("Api.payment.invalid.not_found", \BAD_BUSINESS_RULES);

        $paymentEntity->setBankId($foundBank->getId());
        $paymentEntity->setPaidAmount($payment->__get('transaction_amount'));
        $paymentEntity->setPaymentId($payload->data->id);
        $paymentEntity->setStatus($this->status[$payment->status]);

        $clientsModel = new ClientsModel();

        $metadata = $payment->__get('metadata');

        $foundClientByEmail = $clientsModel->where(["id" => $metadata->client_id])->first();

        if (empty($foundClientByEmail))
            throw new Exceptions("Api.webhooks.mercado_pago.client_not_found", \NOT_FOUND);

        $reference = $metadata->reference;
        $paymentEntity->setClientId($foundClientByEmail->getId());
        $chargesModel = new ChargesModel();

        /** @var ChargeEntity */
        $foundCharge = $chargesModel->where("reference", $reference)->first();

        if (empty($foundCharge))
            throw new Exceptions("Api.webhooks.mercado_pago.charge_not_found", \NOT_FOUND);

        $paymentEntity->setChargeId($foundCharge->getId());

        return $paymentEntity;
    }

    /**
     * @param object{
     *   action: string,
     *   api_version: "v1"|"v2",
     *   data: object{
     *     id: int
     *   },
     *   date_created: string,
     *   id: int,
     *   live_mode: bool,
     *   type: string,
     *   user_id: int
     * } $payload
     */
    public function save(object $payload)
    {
        $paymentEntity = $this->store($payload);

        $paymentsModel = new PaymentsModel();
        $paymentsModel->save($paymentEntity);

        return (object)[
            "success" => "Api.webhooks.mercado_pago.success"
        ];
    }

    /**
     * @param object{
     *   action: string,
     *   api_version: "v1"|"v2",
     *   data: object{
     *     id: int
     *   },
     *   date_created: string,
     *   id: int,
     *   live_mode: bool,
     *   type: string,
     *   user_id: int
     * } $payload
     */
    public function update(object $payload)
    {
        $paymentEntity = $this->store($payload);

        $paymentsModel = new PaymentsModel();
        $paymentsModel->set($paymentEntity->toArray())->where([
            "payment_id" => $payload->data->id
        ])->update();

        return (object)[
            "success" => "Api.webhooks.mercado_pago.success"
        ];
    }
}
