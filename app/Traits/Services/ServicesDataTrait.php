<?php

namespace App\Traits\Services;

use App\Database\Entities\Services\ServiceEntity;

trait ServicesDataTrait
{
    public function builder(ServiceEntity $serviceEntity): Object
    {

        return  (object)[
            "id" => $serviceEntity->getId(),
            "name" => $serviceEntity->getName(),
            "type" => $serviceEntity->getType(),
            "privacy" => $serviceEntity->getPrivacy(),
            "description" => $serviceEntity->getDescription(),
            "photo" => $serviceEntity->getPhoto(),
            "stock" => $serviceEntity->getStock(),
            "reservations" => $serviceEntity->getReservations(),
            "status" => $serviceEntity->getStatus(),
            "created_at" => $serviceEntity->getCreatedAt(),
            "updated_at" => $serviceEntity->getUpdatedAt()
        ];
    }
}
