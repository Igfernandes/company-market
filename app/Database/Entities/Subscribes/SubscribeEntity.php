<?php

namespace App\Database\Entities\Subscribes;

use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;

class SubscribeEntity extends Entity
{
    use EntityEnhancerTrait;

    protected $dates = [];

    public $attributes = [
        'id'            => null,
        'phone_sha256'  => null,
        'type'          => null,
        'data'          => null,
        'created_at'    => null
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

    public function getPhoneSha256(): ?string
    {
        return $this->attributes['phone_sha256'];
    }

    public function setPhoneSha256(?string $phoneSha256): void
    {
        if (!empty($phoneSha256)) {
            $this->attributes['phone_sha256'] = $phoneSha256;
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

    public function getData(): mixed
    {
        return $this->attributes['data'];
    }

    public function setData(mixed $data): void
    {
        $this->attributes['data'] = $data;
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
