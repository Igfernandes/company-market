<?php

namespace App\Database\Entities\Notifications;

use CodeIgniter\Entity\Entity;
use App\Traits\EntityEnhancerTrait;

class NotificationEntity extends Entity
{
    use EntityEnhancerTrait;

    public $attributes = [
        'id'            => null,
        'title'         => null,
        'message'       => null,
        'created_at'    => null,
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'];
    }
    public function setId(?int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getTitle(): ?string
    {
        return $this->attributes['title'];
    }
    public function setTitle(?string $title): void
    {
        $this->attributes['title'] = $title;
    }

    public function getMessage(): ?string
    {
        return $this->attributes['message'];
    }
    public function setMessage(?string $message): void
    {
        $this->attributes['message'] = $message;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }
    public function setCreatedAt(?string $datetime): void
    {
        $this->attributes['created_at'] = $datetime;
    }
}
