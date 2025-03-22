<?php

namespace App\Database\Entities\Permissions;

use App\Database\Entities\Permissions\PermissionEntity;
use App\Database\Entities\Users\GroupEntity;
use CodeIgniter\Entity\Entity;

class GroupPermissionsEntity extends Entity
{
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
     * getUser function
     *
     * @return UsersEntity|null
     */
    public function getUser(): ?GroupEntity
    {
        return $this->attributes['group'];
    }

    /**
     * setUser function
     *
     * @param UsersEntity|null $group
     * @return void
     */
    public function setUser(GroupEntity $group)
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
