<?php

namespace App\Database\Entities\Users;

use CodeIgniter\Entity\Entity;

class UserRoleEntity extends Entity
{
    protected $dates = [];
    public $attributes = [
        'role_id'         => null,
        'role'            => null,
        'user_id'         => null,
        'user'            => null,
        'created_at'      => null,
        'updated_at'      => null
    ];
    public $relations = [
        'role'     => null,
        'user'      => null
    ];

    /**
     * getRoleId function
     *
     * @return Int|null
     */
    public function getRoleId(): ?Int
    {
        return $this->attributes['role_id'];
    }

    /**
     * setRoleId function
     *
     * @param Int|null $roleId
     * @return void
     */
    public function setRoleId(Int $roleId)
    {
        if (!empty($roleId))
            $this->attributes['role_id'] = $roleId;
    }

    /**
     * getRole function
     *
     * @return RoleEntity|null
     */
    public function getRole(): ?RoleEntity
    {
        return $this->relations['role'];
    }

    /**
     * setRole function
     *
     * @param RoleEntity|null $role
     * @return void
     */
    public function setRole(RoleEntity $role)
    {
        if (!empty($role))
            $this->relations['role'] = $role;
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
