<?php

namespace App\Database\Entities\Integrations;

use App\Libraries\Exceptions\Exceptions;
use App\Traits\CryptoEntityTrait;
use CodeIgniter\Entity\Entity;

class IntegrationEntity extends Entity
{
    use CryptoEntityTrait;

    protected $dates = [];
    public $attributes = [
        'id'            => null,
        'provider'      => null,
        'type'          => null,
        'settings'      => null,
        'status'        => null,
        'created_at'    => null,
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

    /**
     * @return string|null
     */
    public function getProvider(): ?string
    {
        return $this->attributes['provider'];
    }

    /**
     * @param string|null $provider
     * @return void
     */
    public function setProvider(?string $provider): void
    {
        if (!empty($provider)) {
            $this->attributes['provider'] = $provider;
        }
    }


    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->attributes['type'];
    }

    /**
     * @param string|null $type
     * @return void
     */
    public function setType(?string $type): void
    {
        if (!empty($type)) {
            $this->attributes['type'] = $type;
        }
    }

    /**
     * @return string|null
     */
    public function getSettings(): ?string
    {
        return $this->attributes['settings'];
    }

    /**
     * @param string|null $settings
     * @return void
     */
    public function setSettings(?string $settings): void
    {
        if (!empty($settings)) {
            $this->attributes['settings'] = $settings;
        }
    }


    /**
     * @method mixed getDecryptSettings()
     *
     * @return String|null
     */
    public function getDecryptSettings()
    {
        if (!empty($this->attributes['settings']))
            return $this->cryptoLibrary->decrypt($this->attributes['settings'], $this->getEncryptedKey());
    }

    /**
     * @method mixed setEncryptSettings()
     *
     * @param String|null $settings
     * @return void
     */
    public function setEncryptSettings(?String $settings)
    {
        if (!empty($settings))
            $this->attributes['settings'] = $this->cryptoLibrary->encrypt($settings, $this->getEncryptedKey());
    }

    /**
     * @method mixed getSystemKey()
     *
     * @return string|null
     */
    public function getSystemKey(): ?string
    {
        return $this->attributes['system_key'];
    }

    /**
     * @method mixed setSystemKey()
     *
     * @param string|null $systemKey
     * @return void
     */
    public function setSystemKey(?string $systemKey)
    {
        if (!empty($systemKey)) {
            $this->attributes['system_key'] = $systemKey;
        }
    }


    /**
     * @method mixed getStatus()
     *
     * @return ACTIVE|INACTIVE|ANALYSIS
     */
    public function getStatus(): ?String
    {
        return $this->attributes['status'];
    }

    /**
     * @method mixed setStatus()
     *
     * @param ACTIVE|INACTIVE|ANALYSIS|null $status
     * @return void
     */
    public function setStatus(?String $status)
    {

        if (array_search($status, ["ACTIVE", "INACTIVE", "ANALYSIS"]) === false)
            throw new Exceptions("Api.integrations.invalid.status", BAD_REQUEST);

        if (!empty($status))
            $this->attributes['status'] = $status;
    }

    /**
     * @method mixed getCompanyId()
     *
     * @return int|null
     */
    public function getCompanyId(): ?int
    {
        return $this->attributes['company_id'];
    }

    /**
     * @method mixed setCompanyId()
     *
     * @param int|null $companyId
     * @return void
     */
    public function setCompanyId(?int $companyId)
    {
        if (!empty($companyId)) {
            $this->attributes['company_id'] = $companyId;
        }
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    /**
     * @param string|null $createdAt
     * @return void
     */
    public function setCreatedAt(?string $createdAt): void
    {
        if (!empty($createdAt)) {
            $this->attributes['created_at'] = $createdAt;
        }
    }

    /**
     * @method mixed getUpdatedAt()
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    /**
     * @method mixed setUpdatedAt()
     *
     * @param string|null $updatedAt
     * @return void
     */
    public function setUpdatedAt(?string $updatedAt)
    {
        if (!empty($updatedAt)) {
            $this->attributes['updated_at'] = $updatedAt;
        }
    }
}
