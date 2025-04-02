<?php

namespace App\Traits\Fields;

use App\Database\Entities\Fields\ClientFieldEntity;
use App\Database\Entities\Fields\FieldEntity;

trait FieldsDataTrait
{
    public function fieldWithClients(FieldEntity $field, array $clientFields): Object
    {
        $foundClientField = \array_filter($clientFields, fn(ClientFieldEntity $clientField) => $clientField->getFieldId() == $field->getId());
        $value = isset($foundClientField[0]) ? $foundClientField[0]->getValue() : null;

        $encodeValue = !empty($value) && $value != "null"  ? \json_decode($value) : (object)["data" => null];

        return  (object)[
            "id"            => $field->getId(),
            "name"          => $field->getName(),
            "type"          => $field->getType(),
            "component"     => $field->getComponent(),
            "group_id"      => $field->getGroupId(),
            "value"         => $encodeValue->data,
            "is_file"       => $field->getIsFile(),
            "is_required"   => $field->getIsRequired(),
            "is_sensitive"  => $field->getIsSensitive(),
            "created_at"    => $field->getCreatedAt(),
            "updated_at"    => $field->getUpdatedAt()
        ];
    }
}
