<?php

namespace App\Database\Entities\Users;

use App\Traits\EntityEnhancerTrait;
use App\Database\Entities\BaseEntity;
use CodeIgniter\Entity\Entity;
use Exception;

use function PHPUnit\Framework\isJson;

class UserTokenEntity extends Entity
{
    use EntityEnhancerTrait;

    public $attributes = [
        'id'              => null,
        'token'           => null,
        'operation'       => null,
        'path'            => null,
        'data'            => null,
        'is_valid'        => null,
        'accessibility'   => null,
        'user_id'         => null,
        'expired_at'      => null,
        'created_at'      => null,
        'updated_at'      => null
    ];
    public $relations = [
        'user'      => null
    ];

    /**
     * getId function
     *
     * @return Int|null
     */
    public function getId(): ?Int
    {
        return $this->attributes['id'];
    }

    /**
     * setId function
     *
     * @param Int|null $id
     * @return void
     */
    public function setId(?Int $id)
    {
        if (!empty($id))
            $this->attributes['id'] = $id;
    }

    /**
     * getToken function
     *
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->attributes['token'];
    }

    /**
     * setToken function
     *
     * @param string|null $token
     * @return void
     */
    public function setToken(?string $token)
    {
        if (!empty($token))
            $this->attributes['token'] = $token;
    }


    /**
     * getOperation function
     *
     * @return String|null
     */
    public function getOperation(): ?String
    {
        return $this->attributes['operation'];
    }

    /**
     * setOperation function
     *
     * @param String|null $operation
     * @return void
     */
    public function setOperation(?String $operation)
    {
        if (!empty($operation))
            $this->attributes['operation'] = $operation;
    }

    /**
     * getPath function
     *
     * @return String|null
     */
    public function getPath(): ?String
    {
        return $this->attributes['path'];
    }

    /**
     * setPath function
     *
     * @param String|null $path
     * @return void
     */
    public function setPath(?String $path)
    {
        if (!empty($path))
            $this->attributes['path'] = $path;
    }

    /**
     * getData function
     *
     * @return String|null
     */
    public function getData(): String|Object|array|null
    {
        return json_decode($this->attributes['data']);
    }

    /**
     * setData function
     *
     * @param String|null $data
     * @return void
     */
    public function setData(Object|array|string|null $data)
    {
        $session = session();

        if (!isJson($data))
            throw new Exception('Validation.invalid_json', INTERNAL_ERROR);

        if (!empty($data))
            $this->attributes['data'] = $data;
    }


    /**
     * getIsValid function
     *
     * @return Bool|null
     */
    public function getIsValid(): ?bool
    {
        return $this->attributes['is_valid'];
    }

    /**
     * setIsValid function
     *
     * @param Bool|null $isValid
     * @return void
     */
    public function setIsValid(?bool $isValid)
    {

        if (!empty($isValid))
            $this->attributes['is_valid'] = $isValid;
    }

    /**
     * getAccessibility function
     *
     * @return ENUM["PUBLIC"|"PRIVATE"]|null
     */
    public function getAccessibility(): ?string
    {
        return $this->attributes['accessibility'];
    }

    /**
     * setAccessibility function
     *
     * @param ENUM["PUBLIC"|"PRIVATE"]|null $accessibility
     * @return void
     */
    public function setAccessibility(?bool $accessibility)
    {
        if (!empty($accessibility))
            $this->attributes['accessibility'] = $accessibility;
    }

    /**
     * getUserId function
     *
     * @return Int|null
     */
    public function getUserId(): ?Int
    {
        return $this->attributes['user_id'];
    }

    /**
     * setUserId function
     *
     * @param Int|null $userId
     * @return void
     */
    public function setUserId(Int $userId)
    {
        if (!empty($userId))
            $this->attributes['user_id'] = $userId;
    }

    /**
     * getUser function
     *
     * @return UsersEntity|null
     */
    public function getUser(): ?UserEntity
    {
        return $this->relations['user'];
    }

    /**
     * setUser function
     *
     * @param UsersEntity|null $user
     * @return void
     */
    public function setUser(UserEntity $user)
    {
        if (!empty($user))
            $this->relations['user'] = $user;
    }

    /**
     * setExpiredAt function
     *
     * @param String|null $createdAt
     * @return void
     */
    public function setExpiredAt(?String $expiredAt)
    {
        if (!empty($expiredAt))
            $this->attributes['expired_at'] = $expiredAt;
    }

    /**
     * getExpiredAt function
     *
     * @return String|null
     */
    public function getExpiredAt(): ?String
    {
        return $this->attributes['expired_at'];
    }

    /**
     * setCreatedAt function
     *
     * @param String|null $createdAt
     * @return void
     */
    public function setCreatedAt(?String $createdAt)
    {
        if (!empty($createdAt))
            $this->attributes['created_at'] = $createdAt;
    }

    /**
     * getCreatedAt function
     *
     * @return String|null
     */
    public function getCreatedAt(): ?String
    {
        return $this->attributes['created_at'];
    }

    /**
     * setUpdatedAt function
     *
     * @param String|null $updatedAt
     * @return void
     */
    public function setUpdatedAt(?String $updatedAt)
    {
        if (!empty($updatedAt))
            $this->attributes['updated_at'] = $updatedAt;
    }

    /**
     * getUpdatedAt function
     *
     * @return String|null
     */
    public function getUpdatedAt(): ?String
    {
        return $this->attributes['updated_at'];
    }
}
