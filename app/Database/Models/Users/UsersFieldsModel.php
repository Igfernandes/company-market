<?php

namespace App\Database\Models\Users;

use App\Database\Entities\Fields\FieldEntity;
use App\Database\Entities\Users\UserFieldEntity;
use App\Database\Entities\Users\UserEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class UsersFieldsModel extends Model
{
     use ModelTrait;
     
    protected $DBGroup          = 'default';
    protected $table            = 'users_fields';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Users\UserFieldEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'client_id', 'value', 'value_encrypted'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function getUsersWithFields(array $userQuery, array $fieldsQuery = []): array
    {
        $inUserIds = isset($userQuery['in_ids']) ? $userQuery['in_ids'] : [];
        unset($userQuery['in_ids']);

        $userQueryUpdated = $this->addPrefixInQuery($userQuery, "users");
        $fieldQueryUpdated = $this->addPrefixInQuery($fieldsQuery, "fields");

        if (count($inUserIds) > 0)
            $this->whereIn("users_id", $inUserIds);

        $founds = $this->Select(" users.*, fields.*, users_fields.value, users_fields.value_encrypted,
        users.name as user_name, users.id as user_id, users.created_at as user_created_at, 
        users.updated_at as user_updated_at,
        fields.name as field_name, fields.id as field_id, fields.created_at as field_created_at,
        fields.updated_at as field_updated_at")
            ->join("users", "users.id = users_fields.user_id")
            ->join("fields", "fields.id = users_fields.field_id")
            ->where($userQueryUpdated)
            ->where($fieldQueryUpdated)->findAll();

        return array_map(function (UserFieldEntity $userFieldData) {
            $userFieldEntity = new UserFieldEntity();
            $userEntity = new UserEntity();
            $fieldEntity = new FieldEntity();

            /** @var array */
            $attributes = $userFieldData->attributes;

            $userEntity->store($attributes);
            $userEntity->setId($attributes['user_id']);
            $userEntity->setName($attributes['user_name']);
            $userEntity->setCreatedAt($attributes['user_created_at']);
            $userEntity->setUpdatedAt($attributes['user_updated_at']);

            $fieldEntity->store($attributes);
            $fieldEntity->setId($attributes['field_id']);
            $fieldEntity->setName($attributes['field_name']);
            $fieldEntity->setCreatedAt($attributes['field_created_at']);
            $fieldEntity->setUpdatedAt($attributes['field_updated_at']);

            $userFieldEntity->setUserId($attributes['user_id']);
            $userFieldEntity->setFieldId($attributes['field_id']);
            $userFieldEntity->setValue($attributes['value']);
            $userFieldEntity->setValueEncrypted($attributes['value_encrypted']);
            $userFieldEntity->setUser($userEntity);
            $userFieldEntity->setField($fieldEntity);

            return $userFieldEntity;
        }, $founds);
    }
}
