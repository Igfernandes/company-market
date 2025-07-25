<?php

namespace App\Database\Entities\Reports;

use CodeIgniter\Entity\Entity;

class SettingsHistoryEntity extends Entity
{
    protected $dates = [];
    public $attributes = [
        'id'            => null,
        'module'        => null,
        'operation'     => null,
        'payload_sent'  => null,
        'status'        => null,
        'created_at'    => null,
        'updated_at'    => null,
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'];
    }

    public function setId(?int $id)
    {
        if (!empty($id)) {
            $this->attributes['id'] = $id;
        }
    }

    public function getModule(): ?string
    {
        return $this->attributes['module'];
    }

    public function setModule(?string $module)
    {
        if (!empty($module)) {
            $this->attributes['module'] = $module;
        }
    }

    public function getOperation(): ?string
    {
        return $this->attributes['operation'];
    }

    public function setOperation(?string $operation)
    {
        if (!empty($operation)) {
            $this->attributes['operation'] = $operation;
        }
    }

    public function getPayloadSent(): ?string
    {
        return $this->attributes['payload_sent'];
    }

    public function setPayloadSent(?string $payloadSent)
    {
        if (!empty($payloadSent)) {
            $this->attributes['payload_sent'] = $payloadSent;
        }
    }

    public function getStatus(): ?string
    {
        return $this->attributes['status'];
    }

    public function setStatus(?string $status)
    {
        if (!empty($status)) {
            $this->attributes['status'] = $status;
        }
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt(?string $createdAt)
    {
        if (!empty($createdAt)) {
            $this->attributes['created_at'] = $createdAt;
        }
    }

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt(?string $updatedAt)
    {
        if (!empty($updatedAt)) {
            $this->attributes['updated_at'] = $updatedAt;
        }
    }
}
