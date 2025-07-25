<?php

namespace App\Database\Entities\Fields;

use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;

class FieldsGroupEntity extends Entity
{
    use EntityEnhancerTrait;

    protected $dates = [];
    public $attributes = [
        'id'         => null,
        'name'       => null,
        'scope'      => null,
        'created_at' => null
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

    public function getScope(): ?string
    {
        return $this->attributes['scope'];
    }

    public function setScope(?string $scope): void
    {
        if (!empty($scope)) {
            $this->attributes['scope'] = $scope;
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
