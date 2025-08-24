<?php

namespace App\Database\Entities\Users;

use App\Database\Entities\Fields\FieldEntity;
use App\Database\Entities\Users\UserEntity;
use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;

class UserFieldEntity extends Entity
{
    use EntityEnhancerTrait;

    protected $dates = [];
    public $attributes = [
        'user_id'       => null,
        'field_id'        => null,
        'value'           => null,
        'value_encrypted' => null,
        'created_at'      => null
    ];
    public $relations = [
        'user'    => null,
        'field'     => null,
    ];

    public function getUserId(): ?int
    {
        return $this->attributes['user_id'];
    }

    public function setUserId(?int $userId): void
    {
        if (!empty($userId)) {
            $this->attributes['user_id'] = $userId;
        }
    }

    public function getUser(): ?UserEntity
    {
        return $this->relations['user'];
    }

    public function setUser(?UserEntity $user): void
    {
        if (!empty($user)) {
            $this->relations['user_id'] = $user;
        }
    }

    public function getFieldId(): ?int
    {
        return $this->attributes['field_id'];
    }

    public function setFieldId(?int $fieldId): void
    {
        if (!empty($fieldId)) {
            $this->attributes['field_id'] = $fieldId;
        }
    }

    public function getField(): ?FieldEntity
    {
        return $this->relations['field'];
    }

    public function setField(?FieldEntity $field): void
    {
        if (!empty($field)) {
            $this->relations['field'] = $field;
        }
    }

    public function getValue(): ?string
    {
        return $this->attributes['value'];
    }

    public function setValue(?string $value): void
    {
 
        if (!empty($value)) {
            $this->attributes['value'] = $value;
        }
    }

    public function getValueEncrypted(): ?string
    {
        return $this->attributes['value_encrypted'];
    }

    public function setValueEncrypted(?string $valueEncrypted): void
    {
        if (!empty($valueEncrypted)) {
            $this->attributes['value_encrypted'] = $valueEncrypted;
        }
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt(?string $createdAt): void
    {
        if (!empty($createdAt)) {
            $this->attributes['created_at'] = $createdAt;
        }
    }
}
