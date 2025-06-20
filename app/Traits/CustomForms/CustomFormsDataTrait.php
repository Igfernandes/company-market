<?php

namespace App\Traits\CustomForms;

use App\Database\Entities\CustomForms\CustomFormEntity;

trait CustomFormsDataTrait
{
    public function builder(CustomFormEntity $customFormsEntity): Object
    {
        return  (object)[
            "id" => $customFormsEntity->getId(),
            "name" => $customFormsEntity->getName(),
            "slug" => $customFormsEntity->getSlug(),
            "description" => $customFormsEntity->getDescription(),
            "components" => $customFormsEntity->getComponents(),
            "status" => $customFormsEntity->getStatus(),
            'service_id' => $customFormsEntity->getServiceId(),
            "started_at" => $customFormsEntity->getStartedAt(),
            "expired_at" => $customFormsEntity->getExpiredAt(),
            "created_at" => $customFormsEntity->getCreatedAt(),
            "updated_at" => $customFormsEntity->getUpdatedAt()
        ];
    }
}
