<?php

namespace App\Database\Entities\Integrations;

use App\Traits\CryptoEntityTrait;
use CodeIgniter\Entity\Entity;

class IntegrationChatEntity extends Entity
{
    use CryptoEntityTrait;

    protected $attributes = [
        'id'            => null,
        'type'          => null,
        'public_token'  => null,
        'private_token' => null,
        'username'      => null,
        'login'         => null,
        'password'      => null,
        'system_key'    => null,
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
            $this->attributes['public_token'] = $this->cryptoLibrary->encrypt(strtolower($publicToken), $this->getEncryptedKey());
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
            $this->attributes['private_token'] = $this->cryptoLibrary->encrypt(strtolower($privateToken), $this->getEncryptedKey());
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
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->attributes['login'];
    }

    /**
     * @param string|null $login
     * @return void
     */
    public function setLogin(?string $login): void
    {
        $this->attributes['login'] = $login;
    }

    /**
     * @method mixed getDecryptLogin()
     *
     * @return String|null
     */
    public function getDecryptLogin()
    {
        return $this->cryptoLibrary->decrypt($this->attributes['login'], $this->getEncryptedKey());
    }

    /**
     * @method mixed setEncryptLogin()
     *
     * @param String|null $login
     * @return void
     */
    public function setEncryptLogin(?String $login)
    {
        if (!empty($login))
            $this->attributes['login'] = $this->cryptoLibrary->encrypt(strtolower($login), $this->getEncryptedKey());
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->attributes['password'];
    }

    /**
     * @param string|null $password
     * @return void
     */
    public function setPassword(?string $password): void
    {
        $this->attributes['password'] = $password;
    }

    /**
     * @method mixed getDecryptPassword()
     *
     * @return String|null
     */
    public function getDecryptPassword()
    {
        return $this->cryptoLibrary->decrypt($this->attributes['password'], $this->getEncryptedKey());
    }

    /**
     * @method mixed setEncryptPassword()
     *
     * @param String|null $password
     * @return void
     */
    public function setEncryptPassword(?String $password)
    {
        if (!empty($password))
            $this->attributes['password'] = $this->cryptoLibrary->encrypt(strtolower($password), $this->getEncryptedKey());
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
