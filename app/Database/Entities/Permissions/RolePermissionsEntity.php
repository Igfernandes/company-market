<?php

namespace App\Database\Entities\Permissions;

use App\Database\Entities\Permissions\PermissionEntity;
use App\Database\Entities\Users\RoleEntity;
use App\Interfaces\IPermissions;
use CodeIgniter\Entity\Entity;

class RolePermissionsEntity extends Entity implements IPermissions
{
    protected $dates = [];
    public $attributes = [
        'permission_id'   => null,
        'role_id'         => null,
        "created_at"      => null,
    ];
    public $relations = [
        'permission'      => null,
        'role'            => null
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
    public function setPermissionId(int $permissionId): void
    {
        if (!empty($permissionId))
            $this->attributes['permission_id'] = $permissionId;
    }

    /**
     * getPermission function
     *
     * @return PermissionEntity|null
     */
    public function getPermission(): ?PermissionEntity
    {
        return $this->relations['permission'];
    }

    /**
     * setPermission function
     *
     * @param PermissionEntity|null $group
     * @return void
     */
    public function setPermission(PermissionEntity $permission)
    {
        if (!empty($permission))
            $this->relations['permission'] = $permission;
    }

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
    public function setRoleId(Int $groupId)
    {
        if (!empty($groupId))
            $this->attributes['role_id'] = $groupId;
    }

    /**
     * getRole function
     *
     * @return RoleEntity|null
     */
    public function getRole(): ?RoleEntity
    {
        return $this->attributes['role'];
    }

    /**
     * setUser function
     *
     * @param RoleEntity|null $role
     * @return void
     */
    public function setRole(RoleEntity $role)
    {
        if (!empty($role))
            $this->attributes['role'] = $role;
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
