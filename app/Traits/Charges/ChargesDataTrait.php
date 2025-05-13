<?php

namespace App\Traits\Charges;

use App\Database\Entities\Finances\ChargeClientEntity;
use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Entities\Services\ServiceEntity;

trait ChargesDataTrait
{
    public function builder(ChargeEntity $chargeEntity, array $services = [], array $chargesClients = []): Object
    {
        $currentService = \array_values(array_filter(
            $services,
            fn(ServiceEntity $service) => $service->getId() === $chargeEntity->getServiceId()
        ));
        $foundClients = \array_values(\array_filter($chargesClients, fn(ChargeClientEntity $chargeClient) => $chargeClient->getChargeId() == $chargeEntity->getId()));

        if (isset($currentService[0]))
            $currentService = [
                "id" => $currentService[0]->getId(),
                "name" => $currentService[0]->getName()
            ];

        return  (object)[
            "id" => $chargeEntity->getId(),
            "title" => $chargeEntity->getTitle(),
            "description" => $chargeEntity->getDescription(),
            "type" => $chargeEntity->getType(),
            "status" => $chargeEntity->getStatus(),
            "price" => $chargeEntity->getPrice(),
            "privacy" => $chargeEntity->getPrivacy(),
            "amount" => $chargeEntity->getAmount(),
            "promotional_price" => $chargeEntity->getPromotionalPrice(),
            "service" => $currentService,
            "clients" => \array_map(fn(ChargeClientEntity $chargeClient) => [
                "id" => $chargeClient->getClientId(),
                "name" => $chargeClient->attributes['client_name'],
            ], $foundClients),
            "created_at" => $chargeEntity->getCreatedAt(),
            "updated_at" => $chargeEntity->getUpdatedAt()
        ];
    }
}
