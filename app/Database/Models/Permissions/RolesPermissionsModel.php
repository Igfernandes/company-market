<?php

namespace App\Database\Models\Permissions;

use App\Database\Entities\Permissions\PermissionEntity;
use App\Database\Entities\Permissions\RolePermissionsEntity;
use App\Database\Entities\Users\RoleEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class RolesPermissionsModel extends Model
{
    use ModelTrait;

    protected $DBGroup          = 'default';
    protected $table            = 'roles_permissions';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Permissions\RolePermissionsEntity';
    protected $protectFields    = true;
    protected $allowedFields    = ['role_id', 'permission_id'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function getRolesWithPermissions(array $roleQuery, array $permissionQuery = []): array
    {
        $inRoleIds = isset($roleQuery['in_ids']) ? $roleQuery['in_ids'] : [];
        unset($roleQuery['in_ids']);

        $inPermissionIds = isset($permissionQuery['in_ids']) ? $permissionQuery['in_ids'] : [];
        unset($permissionQuery['in_ids']);

        $roleQueryUpdated = $this->addPrefixInQuery($roleQuery, "roles");
        $permissionQueryUpdated = $this->addPrefixInQuery($permissionQuery, "permissions");

        if (count($inRoleIds) > 0)
            $this->whereIn("role_id", $inRoleIds);

        if (count($inPermissionIds) > 0)
            $this->whereIn("permission_id", $inPermissionIds);

        $founds = $this->Select("roles.*, permissions.*,
        roles.name as role_name, roles.id as role_id, roles.created_at as role_created_at, 
        roles.updated_at as role_updated_at,
        permissions.name as permission_name, permissions.id as permission_id")
            ->join("roles", "roles.id = roles_permissions.role_id")
            ->join("permissions", "permissions.id = roles_permissions.permission_id")
            ->where($roleQueryUpdated)
            ->where($permissionQueryUpdated)->findAll();

        return array_map(function (RolePermissionsEntity $rolePermissionData) {
            $rolePermission = new RolePermissionsEntity();
            $roleEntity = new RoleEntity();
            $permissionEntity = new PermissionEntity();

            /** @var array */
            $attributes = $rolePermissionData->attributes;

            $roleEntity->store($attributes);
            $roleEntity->setId($attributes['role_id']);
            $roleEntity->setName($attributes['role_name']);
            $roleEntity->setCreatedAt($attributes['role_created_at']);
            $roleEntity->setUpdatedAt($attributes['role_updated_at']);

            $permissionEntity->store($attributes);
            $permissionEntity->setId($attributes['permission_id']);
            $permissionEntity->setName($attributes['permission_name']);

            $rolePermission->setRoleId($attributes['role_id']);
            $rolePermission->setPermissionId($attributes['permission_id']);
            $rolePermission->setRole($roleEntity);
            $rolePermission->setPermission($permissionEntity);

            return $rolePermission;
        }, $founds);
    }
}
