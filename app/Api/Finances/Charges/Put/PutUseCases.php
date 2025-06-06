<?php

namespace App\Api\Finances\Charges\Put;

use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Models\Finances\ChargesModel;
use App\Database\Models\Services\ServicesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;

class PutUseCases
{
    use BusinessTrait;

    /**
     * @param array{
     *     id: integer,
     *     title: string,
     *     description: string,
     *     service_id: string, 
     *     type: 'APPELLANT'|'PUNCTUAL',
     *     privacy: 'PUBLIC'|'PRIVATE',
     *     amount: integer,
     *     price: integer, 
     *     promotional_price: integer,
     *     expired_at: string, 
     *     clients: array{integer}
     * } $payload
     */
    public function execute(array $payload)
    {
        $serviceModel = new ServicesModel();
        $chargesModel = new ChargesModel();

        $foundService =  $serviceModel->where(['id' => $payload['service_id']])->first();

        if (empty($foundService) && !isset($payload['title']))
            throw new Exceptions(\lang("Api.charges.invalid.not_found_service_or_name"), BAD_BUSINESS_RULES);

        $foundCharge = $chargesModel->where("id", $payload['id'])->first();

        if (empty($foundCharge))
            throw new Exceptions(\lang("Errors.not_found"), BAD_REQUEST);

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
        $chargeEntity->setAmount($payload['amount']);

        if (!empty($payload['promotional_price']))
            $chargeEntity->setPromotionalPrice($payload['promotional_price']);

        $chargeEntity->setPrivacy($payload['privacy']);
        $chargeEntity->setType($payload['type']);
        $chargeEntity->setStatus($payload['status']);

        if (!empty($payload['expired_at']))
            $chargeEntity->setExpiredAt($payload['expired_at']);

        $chargesModel->set($chargeEntity->toArray(true))->where("id", $payload['id'])->update();

        return (object)[
            "success" => lang("Api.charges.success.put")
        ];
    }
}
