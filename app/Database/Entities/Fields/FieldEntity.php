<?php

namespace App\Database\Entities\Fields;

use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;

class FieldEntity extends Entity
{
    use EntityEnhancerTrait;

    protected $dates = [];
    public $attributes = [
        'id'          => null,
        'name'        => null,
        'component'   => null,
        'type'        => null,
        'is_sensitive' => null,
        'is_required' => null,
        'group_id'    => null,
        'created_at'  => null,
        'updated_at'  => null
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'];
    }

    public function setId(?int $id): void
    {
        if (!empty($id)) {
            $this->attributes['id'] = $id;
        }
    }

    public function getName(): ?string
    {
        return $this->attributes['name'];
    }

    public function setName(?string $name): void
    {
        if (!empty($name)) {
            $this->attributes['name'] = $name;
        }
    }

    public function getComponent(): ?string
    {
        return $this->attributes['component'];
    }

    public function setComponent(?string $component): void
    {
        if (!empty($component)) {
            $this->attributes['component'] = $component;
        }
    }

    public function getType(): ?string
    {
        return $this->attributes['type'];
    }

    public function setType(?string $type): void
    {
        if (!empty($type)) {
            $this->attributes['type'] = $type;
        }
    }

    public function getIsSensitive(): ?bool
    {
        return $this->attributes['is_sensitive'];
    }

    public function setIsSensitive(?bool $isSensitive): void
    {
        $this->attributes['is_sensitive'] = $isSensitive;
    }

    public function getIsRequired(): ?bool
    {
        return $this->attributes['is_required'];
    }

    public function setIsRequired(?bool $isRequired): void
    {
        $this->attributes['is_required'] = $isRequired;
    }

    public function getGroupId(): ?int
    {
        return $this->attributes['group_id'];
    }

    public function setGroupId(?int $groupId): void
    {
        if (!empty($groupId)) {
            $this->attributes['group_id'] = $groupId;
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

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt(?string $updatedAt): void
    {
        if (!empty($updatedAt)) {
            $this->attributes['updated_at'] = $updatedAt;
        }
    }
}
