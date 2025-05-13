<?php

namespace App\Api\WebHooks\MercadoPago\Post;

use App\Business\WebHooks\MercadoPagoBusiness;
use App\Database\Models\Finances\PaymentsModel;
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
        $foundPayments = $paymentsModel->where(["payment_id" => $payload->data->id])->first();

        if (!empty($foundPayments))
            $payload->action = "payment.updated";

        $actions = [
            "payment.created" => "save",
            "payment.updated" => "update"
        ];

        $actionCurrent = $actions[$payload->action];

        return  $mercadoPagoBusiness->$actionCurrent($payload);
    }
}
