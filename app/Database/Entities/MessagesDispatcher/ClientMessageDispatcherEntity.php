<?php

namespace App\Database\Entities\MessagesDispatcher;

use App\Database\Entities\Clients\ClientEntity;
use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;

class ClientMessageDispatcherEntity extends Entity
{
    use EntityEnhancerTrait;

    public $attributes = [
        'id'                => null,
        'user_id'           => null,
        'message_id'         => null,
        'status'            => null,
        'platform'          => null,
        'log_error'         => null,
        'send_at'           => null,
        'created_at'        => null,
    ];

    public $relations = [
        'user'            => null,
        'message'    => null,
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

    public function setLogError(?string $logError): void
    {
        $this->attributes['log_error'] = $logError;
    }

    public function getSendAt(): ?string
    {
        return $this->attributes['send_at'];
    }
    public function setSendAt(?string $datetime): void
    {
        $this->attributes['send_at'] = $datetime;
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

    public function getMessage(): ?MessageDispatcherEntity
    {
        return $this->relations['message'];
    }
    public function setMessage(?MessageDispatcherEntity $message): void
    {
        $this->relations['message'] = $message;
    }
}
