<?php

namespace App\Database\Entities\Services;

use CodeIgniter\Entity\Entity;

class ServiceRuleEntity extends Entity
{
    protected $dates = ['created_at'];

    public $attributes = [
        'id'         => null,
        'service_id' => null,
        'label'      => null,
        'column'     => null,
        'condition'  => null,
        'value'      => null,
        'created_at' => null,
    ];

    public $relations = [
        "service" => null
    ];

    /**
     * Getters and Setters
     */

    public function getId(): ?int
    {
        return $this->attributes['id'];
    }

    public function setId(?int $id)
    {
        if (!empty($id))
            $this->attributes['id'] = $id;
    }

    public function getServiceId(): ?int
    {
        return $this->attributes['service_id'];
    }

    public function setServiceId(?int $serviceId)
    {
        if (!empty($serviceId))
            $this->attributes['service_id'] = $serviceId;
    }

    public function getLabel(): ?string
    {
        return $this->attributes['label'];
    }

    public function setLabel(?string $label)
    {
        if (!empty($label))
            $this->attributes['label'] = $label;
    }

    public function getColumn(): ?string
    {
        return $this->attributes['column'];
    }

    public function setColumn(?string $column)
    {
        if (!empty($column))
            $this->attributes['column'] = $column;
    }

    public function getCondition(): ?string
    {
        return $this->attributes['condition'];
    }

    public function setCondition(?string $condition)
    {
        if (!empty($condition))
            $this->attributes['condition'] = $condition;
    }

    public function getValue(): ?string
    {
        return $this->attributes['value'];
    }

    public function setValue(?string $value)
    {
        if (!empty($value))
            $this->attributes['value'] = $value;
    }

    /**
     * getService function
     *
     * @return ServiceEntity|null
     */
    public function getService(): ?ServiceEntity
    {
        return $this->attributes['service'];
    }

    /**
     * setService function
     *
     * @param ServiceEntity|null $service
     * @return void
     */
    public function setService(ServiceEntity $service)
    {
        if (!empty($service))
            $this->attributes['service'] = $service;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt(?string $createdAt)
    {
        if (!empty($createdAt))
            $this->attributes['created_at'] = $createdAt;
    }
}
