<?php

namespace App\Database\Entities\Users;

use CodeIgniter\Entity\Entity;
use Exception;

class UserAuthHistoryEntity extends Entity
{
    protected $dates = [];
    public $attributes = [
        'id'              => null,
        'ip'              => null,
        'browser'         => null,
        'token'           => null,
        'user_id'         => null,
        'user'            => null,
        'created_at'      => null
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
        if (strlen($ip) > 30)
            throw new Exception("Api.user_auth_history.invalid.ip_max_length_30", BAD_REQUEST);

        if (!empty($ip))
            $this->attributes['ip'] = $ip;
    }


    /**
     * getBrowser function
     *
     * @return String|null
     */
    public function getBrowser(): ?String
    {
        return $this->attributes['browser'];
    }

    /**
     * setBrowser function
     *
     * @param String|null $browser
     * @return void
     */
    public function setBrowser(?String $browser)
    {
        if (strlen($browser) > 150)
            throw new Exception("Api.user_auth_history.invalid.browser_max_length_150", BAD_REQUEST);

        if (!empty($browser))
            $this->attributes['browser'] = $browser;
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
        if (strlen($token) > 50)
            throw new Exception("Api.user_auth_history.invalid.token_max_length_30", BAD_BUSINESS_RULES);

        if (!empty($token))
            $this->attributes['token'] = $token;
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
        return $this->attributes['user'];
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
            $this->attributes['user'] = $user;
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
}
