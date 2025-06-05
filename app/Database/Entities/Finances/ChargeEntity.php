<?php

namespace App\Database\Entities\Finances;

use App\Traits\CryptoEntityTrait;
use CodeIgniter\Entity\Entity;

class ChargeEntity extends Entity
{
    use CryptoEntityTrait;

    protected $attributes = [
        'id'                 => null,
        'title'             => null,
        'description'       => null,
        'price'             => null,
        'reference'         => null,
        'promotional_price' => null,
        'service_id'        => null,
        'amount'            => null,
        'type'              => null,
        'status'            => null,
        'privacy'           => null,
        'expired_at'        => null,
        'created_at'        => null,
        'updated_at'        => null,
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'];
    }

    public function setId(?int $id): void
    {
        if ($id !== null) {
            $this->attributes['id'] = $id;
        }
    }

    public function getTitle(): ?string
    {
        return $this->attributes['title'];
    }

    public function setTitle(?string $title): void
    {
        $this->attributes['title'] = $title;
    }

    public function getDescription(): ?string
    {
        return $this->attributes['description'];
    }

    public function setDescription(?string $description): void
    {
        $this->attributes['description'] = $description;
    }

    /**
     * getStatus function
     *
     * @return String|null
     */
    public function getStatus(): ?String
    {
        return $this->attributes['status'];
    }

    /**
     * setStatus function
     *
     * @param String|null $status
     * @return void
     */
    public function setStatus(?String $status)
    {
        if (!empty($status))
            $this->attributes['status'] = $status;
    }

    public function getPrice(): ?float
    {
        return $this->attributes['price'];
    }

    public function setPrice(?float $price): void
    {
        $this->attributes['price'] = $price;
    }

    /**
     * getPrivacy function
     *
     * @return String|null
     */
    public function getPrivacy(): ?String
    {
        return $this->attributes['privacy'];
    }

    /**
     * setPrivacy function
     *
     * @param String|null $privacy
     * @return void
     */
    public function setPrivacy(?String $privacy)
    {
        if (!empty($privacy))
            $this->attributes['privacy'] = $privacy;
    }

    public function getAmount(): ?int
    {
        return $this->attributes['amount'];
    }

    public function setAmount(?int $amount): void
    {
        $this->attributes['amount'] = $amount;
    }

    public function getPromotionalPrice(): ?float
    {
        return $this->attributes['promotional_price'];
    }

    public function setPromotionalPrice(?float $promotionalPrice): void
    {
        $this->attributes['promotional_price'] = $promotionalPrice;
    }

    public function getReference(): ?string
    {
        return $this->attributes['reference'];
    }

    public function setReference(?string $reference): void
    {
        if (!empty($reference)) {
            $this->attributes['reference'] = $reference;
        }
    }

    public function getServiceId(): ?int
    {
        return $this->attributes['service_id'];
    }

    public function setServiceId(?int $serviceId): void
    {
        $this->attributes['service_id'] = $serviceId;
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

    public function getExpiredAt(): ?string
    {
        return $this->attributes['expired_at'];
    }

    public function setExpiredAt(?string $expiredAt): void
    {
        $this->attributes['expired_at'] = $expiredAt;
    }


    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->attributes['updated_at'] = $updatedAt;
    }
}
