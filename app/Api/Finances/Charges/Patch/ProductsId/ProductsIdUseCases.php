<?php

namespace App\Api\Users\Patch\ProductsId;

use App\Business\Charges\ChargesBusiness;
use App\Database\Models\Finances\ChargesModel;
use App\Libraries\Exceptions\Exceptions;
use ChargesNotifications;

class ProductsIdUseCases
{
    /**
     * @param array{
     *    id: int,
     *    clients: array{integer}
     * } $payload
     */
    public function execute(array $payload)
    {
        $chargesModel = new ChargesModel();

        $foundCharge = $chargesModel->where("id", $payload['id'])->first();

        if (empty($foundCharge))
            throw new Exceptions(lang("Errors.not_found"), \BAD_BUSINESS_RULES);

        $chargesBusiness = new ChargesBusiness();
        $product =  $chargesBusiness->saveProduct($foundCharge);

        if (isset($payload['clients']) && !empty($payload['clients'])) {
            $chargesNotifications = new ChargesNotifications();
            $chargesNotifications->sendClients($payload['clients'], $product['title'], $foundCharge->getId());
        }

        return (object)[
            "success" => lang("Api.charges.success.patch_products_id")
        ];
    }
}
