<?php

namespace App\Database\Entities\Fields;

use App\Database\Entities\Clients\ClientEntity;
use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;

class ClientFieldEntity extends Entity
{
    use EntityEnhancerTrait;

    public $attributes = [
        'client_id'       => null,
        'field_id'        => null,
        'value'           => null,
        'value_encrypted' => null,
        'created_at'      => null
    ];
    public $relations = [
        'client'    => null,
        'field'     => null,
    ];

    public function getClientId(): ?int
    {
        return $this->attributes['client_id'];
    }

    public function setClientId(?int $clientId): void
    {
        if (!empty($clientId)) {
            $this->attributes['client_id'] = $clientId;
        }
    }

    public function getClient(): ?ClientEntity
    {
        return $this->relations['client'];
    }

    public function setClient(?ClientEntity $client): void
    {
        if (!empty($client)) {
            $this->relations['client_id'] = $client;
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
        helper("json");
        $valueDecode =  \json_decode($value);

        if (!is_object($valueDecode) || !isset($valueDecode->data))
            $value = \json_encode((object)[
                "data" => $value
            ]);

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
