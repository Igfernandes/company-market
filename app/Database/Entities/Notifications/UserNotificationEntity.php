<?php

namespace App\Database\Entities\Notifications;

use App\Database\Entities\Users\UserEntity;
use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;

class UserNotificationEntity extends Entity
{
    use EntityEnhancerTrait;

    protected $dates = [];
    public $attributes = [
        'id'              => null,
        'user_id'         => null,
        'notification_id' => null,
        'created_at'      => null,
    ];

    public $relations = [
        'user'          => null,
        'notification'  => null,
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'];
    }
    public function setId(?int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getUserId(): ?int
    {
        return $this->attributes['user_id'];
    }
    public function setUserId(?int $id): void
    {
        $this->attributes['user_id'] = $id;
    }

    public function getNotificationId(): ?int
    {
        return $this->attributes['notification_id'];
    }
    public function setNotificationId(?int $id): void
    {
        $this->attributes['notification_id'] = $id;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }
    public function setCreatedAt(?string $datetime): void
    {
        $this->attributes['created_at'] = $datetime;
    }

    public function getUser(): ?UserEntity
    {
        return $this->relations['user'];
    }
    public function setUser(?UserEntity $user): void
    {
        $this->relations['user'] = $user;
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
