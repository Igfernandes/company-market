<?php

namespace App\Database\Entities\Permissions;

use App\Database\Entities\Permissions\PermissionEntity;
use App\Database\Entities\Users\GroupEntity;
use App\Interfaces\IPermissions;
use CodeIgniter\Entity\Entity;

class GroupPermissionsEntity extends Entity implements IPermissions
{
    protected $dates = [];
    public $attributes = [
        'permission_id'   => null,
        'group_id'         => null,
        "created_at"      => null,
    ];
    public $relations = [
        'permission'      => null,
        'group'            => null
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
     * getGroupId function
     *
     * @return Int|null
     */
    public function getGroupId(): ?Int
    {
        return $this->attributes['group_id'];
    }

    /**
     * setGroupId function
     *
     * @param Int|null $groupId
     * @return void
     */
    public function setGroupId(Int $groupId)
    {
        if (!empty($groupId))
            $this->attributes['group_id'] = $groupId;
    }

    /**
     * getGroup function
     *
     * @return UsersEntity|null
     */
    public function getGroup(): ?GroupEntity
    {
        return $this->attributes['group'];
    }

    /**
     * setUser function
     *
     * @param UsersEntity|null $group
     * @return void
     */
    public function setGroup(GroupEntity $group)
    {
        if (!empty($group))
            $this->attributes['group'] = $group;
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
