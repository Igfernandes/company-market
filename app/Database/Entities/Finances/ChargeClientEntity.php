<?php

namespace App\Database\Entities\Finances;

use App\Database\Entities\Clients\ClientEntity;
use App\Traits\EntityEnhancerTrait;
use CodeIgniter\Entity\Entity;

class ChargeClientEntity extends Entity
{
    use EntityEnhancerTrait;

    protected $dates = [];
    public $attributes = [
        'client_id'  => null,
        'charge_id'  => null,
        'created_at' => null
    ];
    public $relations = [
        'client'    => null,
        'charge'     => null,
    ];

    public function getClientId(): ?int
    {
        return $this->attributes['client_id'];
    }

    public function setClientId(?int $clientId): void
    {
        if (!empty($clientId)) {
            $this->attributes['client_id'] = $clientId;
        }
    }

    public function getClient(): ?ClientEntity
    {
        return $this->relations['client'];
    }

    public function setClient(?ClientEntity $client): void
    {
        if (!empty($client)) {
            $this->relations['client_id'] = $client;
        }
    }

    public function getChargeId(): ?int
    {
        return $this->attributes['charge_id'];
    }

    public function setChargedId(?int $chargeId): void
    {
        if (!empty($chargeId)) {
            $this->attributes['charge_id'] = $chargeId;
        }
    }

    public function getCharge(): ?ChargeEntity
    {
        return $this->relations['charge'];
    }

    public function setCharge(?ChargeEntity $charge): void
    {
        if (!empty($charge)) {
            $this->relations['charge'] = $charge;
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
