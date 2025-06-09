<?php

namespace App\Database\Entities\Notifications;

use App\Database\Entities\Users\UserEntity;
use CodeIgniter\Entity\Entity;
use App\Traits\EntityEnhancerTrait;

class NotificationEntity extends Entity
{
    use EntityEnhancerTrait;

    protected $dates = [];
    public $attributes = [
        'id'            => null,
        'title'         => null,
        'message'       => null,
        'action'        => null,
        'key'           => null,
        'author_id'     => null,
        'created_at'    => null,
    ];

    public $relations = [
        'user'          => null
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

    public function getAction(): ?string
    {
        return $this->attributes['action'];
    }
    public function setAction(?string $action): void
    {
        $this->attributes['action'] = $action;
    }

    public function getScope(): ?string
    {
        return $this->attributes['scope'];
    }
    public function setScope(?string $scope): void
    {
        $this->attributes['scope'] = $scope;
    }

    public function getKey(): ?int
    {
        return $this->attributes['key'];
    }
    public function setKey(?int $key): void
    {
        $this->attributes['key'] = $key;
    }

    public function getAuthorId(): ?int
    {
        return $this->attributes['author_id'];
    }
    public function setAuthorId(?int $authorId): void
    {
        $this->attributes['author_id'] = $authorId;
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }
    public function setCreatedAt(?string $datetime): void
    {
        $this->attributes['created_at'] = $datetime;
    }

    public function getAuthor(): ?UserEntity
    {
        return $this->relations['user'];
    }
    public function setAuthor(?UserEntity $user): void
    {
        $this->relations['user'] = $user;
    }
}
