<?php

namespace App\Api\Finances\Charges\Post;

use App\Business\Charges\ChargesNotifications;
use App\Business\Clients\ClientsBusiness;
use App\Business\Charges\ChargeScheduleBusiness;
use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Models\Finances\ChargesModel;
use App\Database\Models\Services\ServicesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;

class PostUseCases
{
    use BusinessTrait;

    /**
     * @param array{
     *     title: string,
     *     description: string,
     *     service_id: string, 
     *     type: 'APPELLANT'|'PUNCTUAL',
     *     privacy: 'PUBLIC'|'PRIVATE',
     *     period: integer,
     *     amount: integer,
     *     price: integer, 
     *     promotional_price: integer,
     *     expired_days: integer, 
     *     started_at: string
     *     clients: array{integer}
     * } $payload
     */
    public function execute(array $payload)
    {
        $serviceModel = new ServicesModel();
        $clientsBusiness = new ClientsBusiness();

        $foundService =  $serviceModel->where(['id' => $payload['service_id']])->first();

        if (empty($foundService) && !isset($payload['title']))
            throw new Exceptions(\lang("Api.charges.invalid.not_found_service_or_name"), BAD_BUSINESS_RULES);
        if (!empty($payload['clients']) && !$clientsBusiness->hasClients($payload['clients']))
            throw new Exceptions(\str_replace("{field}", lang("Words.client"),  lang("Validation.not_found")), BAD_BUSINESS_RULES);

        $chargesModel = new ChargesModel();
        $chargeEntity = new ChargeEntity();

        if (isset($payload['title']) && !empty($payload['title']))
            $title = $payload['title'];
        else {
            $title = $foundService->getName();
        }

        $chargeEntity->setTitle($title);

        if (!empty($payload['description']))
            $chargeEntity->setDescription($payload['description']);

        $chargeEntity->setServiceId($payload['service_id']);
        $chargeEntity->setPrice($payload['price']);
        
        if (!empty($payload['started_at']))
            $chargeEntity->setStartedAt($payload['started_at']);

        if (!empty($payload['amount']))
            $chargeEntity->setAmount($payload['amount']);

        if (!empty($payload['period']))
            $chargeEntity->setPeriod($payload['period']);

        if (!empty($payload['promotional_price']))
            $chargeEntity->setPromotionalPrice($payload['promotional_price']);

        $chargeEntity->setPrivacy($payload['privacy']);
        $chargeEntity->setType($payload['type']);

        $chargeEntity->setExpiredDays($payload['expired_days']);

        $chargeEntity->setReference(md5($title . date("YmdHS")));
        $chargesModel->save($chargeEntity->toArray(true));
        $chargeId = $chargesModel->getInsertID();

        $chargeEntity->setId($chargeId);

        if (isset($payload['clients']) && !empty($payload['clients'])) {
            $chargesNotifications = new ChargesNotifications();
            $chargesNotifications->sendClients($payload['clients'], $title, $chargeEntity);
        }

        if (isset($payload['period']) && $payload['type'] === "APPELLANT") {
            ChargeScheduleBusiness::schedule($chargeEntity, $chargeEntity->getStartedAt());
        }

        return (object)[
            "success" => lang("Api.charges.success.post")
        ];
    }
}
