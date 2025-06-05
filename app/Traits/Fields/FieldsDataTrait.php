<?php

namespace App\Traits\Fields;

use App\Database\Entities\Fields\ClientFieldEntity;
use App\Database\Entities\Fields\FieldEntity;
use App\Libraries\Crypto\Crypto;
use VARIANT;

trait FieldsDataTrait
{
    public function fieldWithClients(FieldEntity $field, array $clientFields): Object
    {
        $foundClientField = \array_values(\array_filter($clientFields, fn(ClientFieldEntity $clientField) => $clientField->getFieldId() == $field->getId()));
        $data = isset($foundClientField[0]) ? $foundClientField[0]->getValue() : null;

        $encodeData = !empty($data) && $data != "null"  ? \json_decode($data) : (object)["data" => null];

        if ($field->getIsSensitive() && isset($foundClientField[0])) {
            $crypto = new Crypto();
            $encryptedKey = $foundClientField[0]->getClientId() . ":" . getenv('system.encrypted_key');

            $value = $crypto->decrypt($foundClientField[0]->getValueEncrypted(),  $encryptedKey);
        } else {
            $value = $encodeData->data;
        }

        return  (object)[
            "id"            => $field->getId(),
            "name"          => $field->getName(),
            "type"          => $field->getType(),
            "component"     => $field->getComponent(),
            "group_id"      => $field->getGroupId(),
            "value"         =>  $value,
            "is_required"   => $field->getIsRequired(),
            "is_sensitive"  => $field->getIsSensitive(),
            "created_at"    => $field->getCreatedAt(),
            "updated_at"    => $field->getUpdatedAt()
        ];
    }
}
