<?php

namespace App\Business\Permissions;

use App\Business\BaseBusiness;
use App\Database\Models\Permissions\PermissionsModel;
use App\Database\Models\Permissions\RolesPermissionsModel;
use App\Database\Models\Permissions\UsersPermissionsModel;
use App\Interfaces\IPermissions;
use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\BaseModel;

class PermissionsValidationBusiness
{
    use BaseBusiness;
    /**
     * @param array{Int} $permissions
     */
    public function hasPermissionsAvailable($permissions): bool
    {
        $permissionsModel = new PermissionsModel();
        if (!is_array($permissions)) return false;

        $foundPermissions = $permissionsModel->whereIn("id", $permissions)->findAll();

        return count($foundPermissions) == count($permissions);
    }

    public function store(array $permissions, IPermissions $entity, BaseModel $model)
    {
        foreach ($permissions as $permission) {
            $entity->setPermissionId($permission);

            $model->upsert($entity->toArray(true), $entity);
        }
    }
    
    public static function hasPermissionUser(string $scope, string $type, int $userId)
    {
        $usersPermissions = new UsersPermissionsModel();
        $rolesPermissionsModel = new RolesPermissionsModel();

        $foundPermissions = $usersPermissions
            ->join("permissions", "permissions.id = users_permissions.permission_id")
            ->where([
                "users_permissions.user_id" => $userId,
                "permissions.scope" => $scope,
                "permissions.type" => $type
            ])->findAll();

        $foundRolePermissions = $rolesPermissionsModel
            ->join("users_roles", "users_roles.role_id = roles_permissions.role_id")
            ->join("permissions", "permissions.id = roles_permissions.permission_id")
            ->where([
                "users_roles.user_id" => $userId,
                "permissions.scope" => $scope,
                "permissions.type" => $type
            ])->findAll();

        return count($foundPermissions) > 0 || \count($foundRolePermissions) > 0;
    }

    public static function hasPermissionUserAuth(array $permissionQuery = [])
    {
        $permissions =  PermissionsSearchBusiness::getPermissionUserAuth($permissionQuery);

        if (count($permissions) === 0)
            throw new Exceptions('Api.users.invalid.not_permission', FORBIDDEN_ERROR);
    }

    public static function applyOwnershipRestriction(array $permissionQuery = [], array $payload = [])
    {
        $session = session();
        $permissions =  PermissionsSearchBusiness::getPermissionUserAuth($permissionQuery);

        if (count($permissions) === 0)
            $payload['owner_id'] = $session->get('userAuthId');

        return $payload;
    }
    
}
