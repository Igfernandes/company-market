<?php

namespace App\Traits\Fields;

use App\Database\Entities\Fields\FieldsGroupEntity;

trait FieldsGroupsDataTrait
{
    public function builder(FieldsGroupEntity $fieldsGroup): Object
    {
        return  (object)[
            "id" => $fieldsGroup->getId(),
            "name" => $fieldsGroup->getName(),
            "scope" => $fieldsGroup->getScope(),
            "created_at" => $fieldsGroup->getCreatedAt(),
        ];
    }
}
