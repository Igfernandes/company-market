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
            "type" => $customFormsEntity->getType(),
            "slug" => $customFormsEntity->getSlug(),
            "description" => $customFormsEntity->getDescription(),
            "components" => $customFormsEntity->getComponents(),
            "status" => $customFormsEntity->getStatus(),
            "created_at" => $customFormsEntity->getCreatedAt(),
            "updated_at" => $customFormsEntity->getUpdatedAt()
        ];
    }
}
