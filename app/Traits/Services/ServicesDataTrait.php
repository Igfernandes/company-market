<?php

namespace App\Traits\Services;

use App\Database\Entities\Services\ServiceEntity;
use App\Database\Entities\Services\ServiceRuleEntity;

trait ServicesDataTrait
{
    public function builder(ServiceEntity $serviceEntity, ?array $servicesRules = []): Object
    {

        $rules = null;
        /** 
         * @var ServiceRuleEntity
         */
        foreach ($servicesRules as $serviceRule) {
            if ($serviceRule->getServiceId() == $serviceEntity->getId()) {
                $rules = $serviceRule->getValue();
            }
        }

        return  (object)[
            "id" => $serviceEntity->getId(),
            "name" => $serviceEntity->getName(),
            "description" => $serviceEntity->getDescription(),
            "photo" => getPublicUrl($serviceEntity->getPhoto() ?? ""),
            "stock" => $serviceEntity->getStock(),
            "realized_at" => $serviceEntity->getRealizedAt(),
            "expired_at" => $serviceEntity->getExpiredAt(),
            "address" => $serviceEntity->getAddress(),
            "status" => $serviceEntity->getStatus(),
            "gratuity" => $rules,
            "created_at" => $serviceEntity->getCreatedAt(),
            "updated_at" => $serviceEntity->getUpdatedAt()
        ];
    }
}
