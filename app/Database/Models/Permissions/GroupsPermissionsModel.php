<?php

namespace App\Database\Models\Permissions;

use App\Database\Entities\Permissions\GroupPermissionsEntity;
use App\Database\Entities\Permissions\PermissionEntity;
use App\Database\Entities\Users\GroupEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class GroupsPermissionsModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'groups_permissions';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Permissions\GroupPermissionsEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['group_id', 'permission_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function getGroupsWithPermissions(array $groupQuery, array $permissionQuery = []): array
    {
        $groupQueryUpdated = $this->addPrefixInQuery($groupQuery, "groups");
        $permissionQueryUpdated = $this->addPrefixInQuery($permissionQuery, "permissions");

        $inUserIds = isset($groupQuery['in_ids']) ? $groupQuery['in_ids'] : [];
        unset($groupQuery['in_ids']);

        if (count($inUserIds) > 0)
            $this->whereIn("user_id", $inUserIds);

        $inGroupIds = isset($permissionQuery['in_ids']) ? $permissionQuery['in_ids'] : [];
        unset($permissionQuery['in_ids']);

        if (count($inGroupIds) > 0)
            $this->whereIn("group_id", $inGroupIds);

        $founds = $this->Select("groups.*, permissions.*,
        groups.name as group_name, groups.id as group_id, groups.created_at as group_created_at, 
        groups.updated_at as group_updated_at,
        permissions.name as permission_name, permissions.id as permission_id")
            ->join("groups", "groups.id = groups_permissions.group_id")
            ->join("permissions", "permissions.id = groups_permissions.permission_id")
            ->where($groupQueryUpdated)
            ->where($permissionQueryUpdated)->findAll();

        return array_map(function (GroupPermissionsEntity $groupPermissionData) {
            $groupPermission = new GroupPermissionsEntity();
            $groupEntity = new GroupEntity();
            $permissionEntity = new PermissionEntity();

            /** @var array */
            $attributes = $groupPermissionData->attributes;

            $groupEntity->store($attributes);
            $groupEntity->setId($attributes['group_id']);
            $groupEntity->setName($attributes['group_name']);
            $groupEntity->setCreatedAt($attributes['group_created_at']);
            $groupEntity->setUpdatedAt($attributes['group_updated_at']);

            $permissionEntity->store($attributes);
            $permissionEntity->setId($attributes['permission_id']);
            $permissionEntity->setName($attributes['permission_name']);

            $groupPermission->setGroupId($attributes['group_id']);
            $groupPermission->setPermissionId($attributes['permission_id']);
            $groupPermission->setGroup($groupEntity);
            $groupPermission->setPermission($permissionEntity);

            return $groupPermission;
        }, $founds);
    }
}
