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
        'public_token'  => null,
        'private_token' => null,
        'username'      => null,
        'action'        => null,
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
     * getLogotype function
     *
     * @return String|null
     */
    public function getLogotype(): ?String
    {
        return $this->attributes['logotype'];
    }

    /**
     * setLogotype function
     *
     * @param String|null $logotype
     * @return void
     */
    public function setLogotype(?String $logotype)
    {
        if (!empty($logotype))
            $this->attributes['logotype'] = $logotype;
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
    public function getAction(): ?string
    {
        return $this->attributes['action'];
    }

    /**
     * @param string|null $action
     * @return void
     */
    public function setAction(?string $action): void
    {
        if (!empty($action)) {
            $this->attributes['action'] = $action;
        }
    }

    /**
     * @return string|null
     */
    public function getPublicToken(): ?string
    {
        return $this->attributes['public_token'];
    }

    /**
     * @param string|null $token
     * @return void
     */
    public function setPublicToken(?string $token): void
    {
        $this->attributes['public_token'] = $token;
    }

    /**
     * @method mixed getDecryptPublicToken()
     *
     * @return String|null
     */
    public function getDecryptPublicToken()
    {
        return $this->cryptoLibrary->decrypt($this->attributes['public_token'], $this->getEncryptedKey());
    }

    /**
     * @method mixed setEncryptPublicToken()
     *
     * @param String|null $publicToken
     * @return void
     */
    public function setEncryptPublicToken(?String $publicToken)
    {
        if (!empty($publicToken))
            $this->attributes['public_token'] = $this->cryptoLibrary->encrypt($publicToken, $this->getEncryptedKey());
    }

    /**
     * @return string|null
     */
    public function getPrivateToken(): ?string
    {
        return $this->attributes['private_token'];
    }

    /**
     * @param string|null $token
     * @return void
     */
    public function setPrivateToken(?string $token): void
    {
        $this->attributes['private_token'] = $token;
    }

    /**
     * @method mixed getDecryptPrivateToken()
     *
     * @return String|null
     */
    public function getDecryptPrivateToken()
    {
        return $this->cryptoLibrary->decrypt($this->attributes['private_token'], $this->getEncryptedKey());
    }

    /**
     * @method mixed setEncryptPrivateToken()
     *
     * @param String|null $privateToken
     * @return void
     */
    public function setEncryptPrivateToken(?String $privateToken)
    {
        if (!empty($privateToken))
            $this->attributes['private_token'] = $this->cryptoLibrary->encrypt($privateToken, $this->getEncryptedKey());
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->attributes['username'];
    }

    /**
     * @param string|null $username
     * @return void
     */
    public function setUsername(?string $username): void
    {
        $this->attributes['username'] = $username;
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
            throw new Exceptions("Api.integrations.invalid.status_max_length_200", BAD_REQUEST);

        if (!empty($status))
            $this->attributes['status'] = $status;
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
}
