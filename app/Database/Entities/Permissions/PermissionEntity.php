<?php

namespace App\Database\Entities\Permissions;

use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;

class PermissionEntity extends Entity
{
    use EntityEnhancerTrait;

    protected $dates = [];
    public $attributes = [
        'id'             => null,
        'name'           => null,
        'type'           => null,
        'scope'          => null,
    ];

    /**
     * getId function
     *
     * @return Int|null
     */
    public function getId(): ?Int
    {
        return $this->attributes['id'];
    }

    /**
     * setId function
     *
     * @param Int|null $id
     * @return void
     */
    public function setId(?Int $id)
    {
        if (!empty($id))
            $this->attributes['id'] = $id;
    }

    /**
     * getName function
     *
     * @return String|null
     */
    public function getName(): ?String
    {
        return $this->attributes['name'];
    }

    /**
     * setName function
     *
     * @param String|null $name
     * @return void
     */
    public function setName(?String $name)
    {
        if (!empty($name))
            $this->attributes['name'] = $name;
    }

    /**
     * Get the value of type
     *
     * @return String|null
     */
    public function getType(): ?String
    {
        return $this->attributes['type'] ?? null;
    }

    /**
     * Set the value of type
     *
     * @param String|null $type
     * @return void
     */
    public function setType(?String $type): void
    {
        if (!empty($type)) {
            $this->attributes['type'] = $type;
        }
    }

    /**
     * Get the value of scope
     *
     * @return String|null
     */
    public function getScope(): ?String
    {
        return $this->attributes['scope'] ?? null;
    }

    /**
     * Set the value of scope
     *
     * @param String|null $scope
     * @return void
     */
    public function setScope(?String $scope): void
    {
        if (!empty($scope)) {
            $this->attributes['scope'] = $scope;
        }
    }

    /**
     * setCreatedAt function
     *
     * @param String|null $createdAt
     * @return void
     */
    public function setCreatedAt(?String $createdAt)
    {
        if (!empty($createdAt))
            $this->dates['created_at'] = $createdAt;
    }

    /**
     * getCreatedAt function
     *
     * @return String|null
     */
    public function getCreatedAt(): ?String
    {
        return $this->dates['created_at'];
    }
}
