<?php

namespace App\Api\Operations\Webhooks\MercadoPago\Post;

use App\Business\WebHooks\MercadoPagoBusiness;
use App\Database\Models\Finances\PaymentsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use App\Traits\BusinessTrait;

class PostUseCases
{
    use BusinessTrait;

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
    public function execute(object $payload)
    {
        $mercadoPagoBusiness = new MercadoPagoBusiness();
        $paymentsModel = new PaymentsModel();

        if (property_exists((object)$payload, "data") === false)
            throw new Exceptions("Api.mercado_pago.invalid.operation_failed", BAD_BUSINESS_RULES);

        $foundPayments = $paymentsModel->where(["payment_id" => $payload->data->id])->first();

        if (!empty($foundPayments))
            $payload->action = "payment.updated";

        $actions = [
            "payment.created" => "save",
            "payment.updated" => "update"
        ];

        if (!isset($actions[$payload->action]))
            throw new Exceptions("Api.mercado_pago.invalid.operation_failed", BAD_BUSINESS_RULES);

        $actionCurrent = $actions[$payload->action];
        
        NotificationsService::store([
            "scope" => "charges",
            "action" => "UPDATE"
        ]);
        return  $mercadoPagoBusiness->$actionCurrent($payload);
    }
}
