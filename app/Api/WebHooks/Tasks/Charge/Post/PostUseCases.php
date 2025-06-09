<?php

namespace App\Api\Webhooks\Tasks\Charge\Post;

use App\Business\Charges\ChargesNotifications;
use App\Business\Charges\ChargeScheduleBusiness;
use App\Database\Entities\Finances\ChargeClientEntity;
use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Models\Finances\ChargesClientsModel;
use App\Database\Models\Finances\ChargesModel;
use App\Libraries\Exceptions\Exceptions;

class PostUseCases
{
    /**
     * @param array{
     *   k: string
     */
    public function execute(array $payload)
    {
        $chargesModel = new ChargesModel();

        /** @var ChargeEntity */
        $charge  = $chargesModel->where([
            "reference" => $payload['k'],
            "status" => "ACTIVE",
            "type" => "APPELLANT"
        ])->first();

        if (empty($charge))
            throw new Exceptions(lang("Errors.not_found"), \NOT_FOUND);

        $chargesClientsModel = new ChargesClientsModel();

        $clients = $chargesClientsModel->where("charge_id", $charge->getId())->findAll();

        if (count($clients) > 0) {
            $chargesNotifications = new ChargesNotifications();
            $chargesNotifications->sendClients(
                \array_map(fn(ChargeClientEntity $chargeClient) => $chargeClient->getClientId(), $clients),
                $charge->getTitle(),
                $charge
            );
        }

        ChargeScheduleBusiness::schedule($charge);

        return (object)[
            "success" => lang("Api.charge.success.post")
        ];
    }
}
