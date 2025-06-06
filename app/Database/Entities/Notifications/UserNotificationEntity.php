<?php

namespace App\Database\Entities\Notifications;

use App\Database\Entities\Clients\ClientEntity;
use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;

class UserNotificationEntity extends Entity
{
    use EntityEnhancerTrait;

    public $attributes = [
        'id'              => null,
        'client_id'       => null,
        'message_id'      => null,
        'status'          => null,
        'platform'        => null,
        'log_error'       => null,
        'created_at'      => null,
    ];

    public $relations = [
        'client'       => null,
        'message'      => null,
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'];
    }
    public function setId(?int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getClientId(): ?int
    {
        return $this->attributes['client_id'];
    }
    public function setClientId(?int $id): void
    {
        $this->attributes['client_id'] = $id;
    }

    public function getMessageId(): ?int
    {
        return $this->attributes['message_id'];
    }
    public function setMessageId(?int $id): void
    {
        $this->attributes['message_id'] = $id;
    }

    public function getStatus(): ?string
    {
        return $this->attributes['status'];
    }
    public function setStatus(?string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function getPlatform(): ?string
    {
        return $this->attributes['platform'];
    }
    public function setPlatform(?string $platform): void
    {
        $this->attributes['platform'] = $platform;
    }

    public function getLogError(): ?string
    {
        return $this->attributes['log_error'];
    }
    public function setLogError(?string $error): void
    {
        $this->attributes['log_error'] = $error;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }
    public function setCreatedAt(?string $datetime): void
    {
        $this->attributes['created_at'] = $datetime;
    }

    public function getClient(): ?ClientEntity
    {
        return $this->relations['client'];
    }
    public function setClient(?ClientEntity $client): void
    {
        $this->relations['client'] = $client;
    }

    public function getNotification(): ?NotificationEntity
    {
        return $this->relations['notification'];
    }
    public function setNotification(?NotificationEntity $notification): void
    {
        $this->relations['notification'] = $notification;
    }
}
