<?php

namespace App\Traits\Services;

use App\Database\Entities\Services\ServiceEntity;

trait ServicesDataTrait
{
    public function builder(ServiceEntity $serviceEntity): Object
    {
        return  (Object)[
            "id" => $serviceEntity->getId(),
            "name" => $serviceEntity->getName(),
            "description" => $serviceEntity->getDescription(),
            "photo" => getPublicUrl($serviceEntity->getPhoto() ?? ""),
            "stock" => $serviceEntity->getStock(),
            "realized_at" => $serviceEntity->getRealizedAt(),
            "expired_at" => $serviceEntity->getExpiredAt(),
            "address" => $serviceEntity->getAddress(),
            "status" => $serviceEntity->getStatus(),
            "created_at" => $serviceEntity->getCreatedAt(),
            "updated_at" => $serviceEntity->getUpdatedAt()
        ];
    }
}
