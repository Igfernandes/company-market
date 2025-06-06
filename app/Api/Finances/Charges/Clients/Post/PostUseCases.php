<?php

namespace App\Api\Finances\Charges\Clients\Post;

use App\Business\Charges\ChargesBusiness;
use App\Business\Charges\ChargesNotifications;
use App\Database\Entities\Finances\ChargeEntity;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;

class PostUseCases
{
    use BusinessTrait;

    /**
     * @param array{
     *     charge_id: string,
     *     clients: array{integer}
     * } $payload
     */
    public function execute(array $payload)
    {
        $chargesBusiness = new ChargesBusiness();

        $response =  $chargesBusiness->getAvailableCharge([
            "charges.id" => $payload['charge_id']
        ]);

        if ($response == false)
            throw new Exceptions(\lang("charges.invalid.not_available"), \BAD_BUSINESS_RULES);

        /** @var chargeEntity */
        $charge = $response['charge'];

        if (isset($payload['clients']) && !empty($payload['clients'])) {
            $chargesNotifications = new ChargesNotifications();
            $chargesNotifications->sendClients($payload['clients'], $charge->getTitle(), $charge);
        }

        return (object)[
            "success" => lang("Api.charges.clients.success.post")
        ];
    }
}
