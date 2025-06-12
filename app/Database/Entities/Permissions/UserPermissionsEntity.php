<?php

namespace App\Database\Entities\Permissions;

use App\Database\Entities\Permissions\PermissionEntity;
use App\Database\Entities\Users\UserEntity;
use CodeIgniter\Entity\Entity;

class UserPermissionsEntity extends Entity
{
    protected $dates = [];
    public $attributes = [
        'permission_id'   => null,
        'user_id'         => null,
        "created_at"      => null,
    ];
    public $relations = [
        'permission'      => null,
        'user'            => null
    ];

    /**
     * getPermissionId function
     *
     * @return Int|null
     */
    public function getPermissionId(): ?Int
    {
        return $this->attributes['permission_id'];
    }

    /**
     * setPermissionId function
     *
     * @param Int|null $permissionId
     * @return void
     */
    public function setPermissionId(Int $permissionId)
    {
        if (!empty($permissionId))
            $this->attributes['permission_id'] = $permissionId;
    }

    /**
     * getPermission function
     *
     * @return PermissionEntity|null
     */
    public function getGroup(): ?PermissionEntity
    {
        return $this->relations['permission'];
    }

    /**
     * setPermission function
     *
     * @param PermissionEntity|null $user
     * @return void
     */
    public function setPermission(PermissionEntity $permission)
    {
        if (!empty($permission))
            $this->relations['permission'] = $permission;
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
