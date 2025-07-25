<?php

namespace App\Database\Entities\Users;

use CodeIgniter\Entity\Entity;
use Exception;

class RememberEntity extends Entity
{
    protected $dates = [];
    public $attributes = [
        'id'              => null,
        'token'           => null,
        'ip'              => null,
        'user_id'         => null,
        'created_at'      => null
    ];
    public $entities = [
        "user" => null
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
     * @return String|null
     */
    public function getToken(): ?String
    {
        return $this->attributes['token'];
    }

    /**
     * setToken function
     *
     * @param String|null $token
     * @return void
     */
    public function setToken(?String $token)
    {
        if (strlen($token) > 20)
            throw new Exception("Api.remember.invalid.token_max_length_20", BAD_BUSINESS_RULES);

        if (!empty($token))
            $this->attributes['token'] = $token;
    }

    /**
     * getIp function
     *
     * @return String|null
     */
    public function getIp(): ?String
    {
        return $this->attributes['ip'];
    }

    /**
     * setIp function
     *
     * @param String|null $ip
     * @return void
     */
    public function setIp(?String $ip)
    {
        if (strlen($ip) > 100)
            throw new Exception("Api.remember.invalid.token_max_length_100", BAD_BUSINESS_RULES);

        if (!empty($ip))
            $this->attributes['ip'] = $ip;
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
    public function getUser(): UserEntity|null
    {
        return $this->entities['user'];
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
            $this->entities['user'] = $user;
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
            $this->dates['created_at'] = $createdAt;
    }

    /**
     * getCreatedAt function
     *
     * @return String|null
     */
    public function getCreatedAt(): ?String
    {
        return $this->dates['created_at'];
    }
}
