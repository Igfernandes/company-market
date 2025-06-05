<?php

namespace App\Database\Entities\Finances;

use App\Traits\CryptoEntityTrait;
use CodeIgniter\Entity\Entity;

class PaymentEntity extends Entity
{
    use CryptoEntityTrait;

    protected $attributes = [
        'id'           => null,
        'payment_id'   => null,
        'paid_amount'  => null,
        'client_id'    => null,
        'charge_id'    => null,
        'bank_id'      => null,
        'status'       => null,
        'created_at'   => null,
        'updated_at'   => null
    ];

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->attributes['id'];
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void
    {
        if ($id !== null) {
            $this->attributes['id'] = $id;
        }
    }

    public function getPaymentId(): ?string
    {
        return $this->attributes['payment_id'];
    }

    public function setPaymentId(?string $paymentId): void
    {
        $this->attributes['payment_id'] = $paymentId;
    }

    public function getDecryptPaymentId()
    {
        return $this->cryptoLibrary->decrypt($this->attributes['payment_id'], $this->getEncryptedKey());
    }

    public function setEncryptPaymentId(?string $paymentId): void
    {
        if (!empty($paymentId)) {
            $this->attributes['payment_id'] = $this->cryptoLibrary->encrypt($paymentId, $this->getEncryptedKey());
        }
    }

    public function getPaidAmount(): ?float
    {
        return $this->attributes['paid_amount'];
    }

    public function setPaidAmount(?float $amount): void
    {
        $this->attributes['paid_amount'] = $amount;
    }

    public function getStatus(): ?string
    {
        return $this->attributes['status'];
    }

    public function setStatus(?string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function getBankId(): ?int
    {
        return $this->attributes['bank_id'];
    }

    public function setBankId(?int $bankId): void
    {
        $this->attributes['bank_id'] = $bankId;
    }

    public function getClientId(): ?int
    {
        return $this->attributes['client_id'];
    }

    public function setClientId(?int $clientId): void
    {
        $this->attributes['client_id'] = $clientId;
    }

    public function getChargeId(): ?int
    {
        return $this->attributes['charge_id'];
    }

    public function setChargeId(?int $chargeId): void
    {
        $this->attributes['charge_id'] = $chargeId;
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
