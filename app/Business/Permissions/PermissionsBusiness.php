<?php

namespace App\Business\Permissions;

use App\Business\BaseBusiness;
use App\Database\Entities\Permissions\GroupPermissionsEntity;
use App\Database\Entities\Users\UserGroupsEntity;
use App\Database\Models\Permissions\GroupsPermissionsModel;
use App\Database\Models\Permissions\PermissionsModel;
use App\Database\Models\Permissions\UsersPermissionsModel;
use App\Database\Models\Users\UsersGroupsModel;
use App\Interfaces\IPermissions;
use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\BaseModel;

class PermissionsBusiness
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
        $groupsPermissionsModel = new GroupsPermissionsModel();

        $foundPermissions = $usersPermissions
            ->join("permissions", "permissions.id = users_permissions.permission_id")
            ->where([
                "users_permissions.user_id" => $userId,
                "permissions.scope" => $scope,
                "permissions.type" => $type
            ])->findAll();

        $foundGroupPermissions = $groupsPermissionsModel
            ->join("users_groups", "users_groups.group_id = groups_permissions.group_id")
            ->join("permissions", "permissions.id = groups_permissions.permission_id")
            ->where([
                "users_groups.user_id" => $userId,
                "permissions.scope" => $scope,
                "permissions.type" => $type
            ])->findAll();

        return count($foundPermissions) > 0 || \count($foundGroupPermissions) > 0;
    }

    public static function hasPermissionUserAuth(array $permissionQuery = [])
    {
        $permissions =  PermissionsBusiness::getPermissionUserAuth($permissionQuery);

        if (count($permissions) === 0)
            throw new Exceptions('Api.users.invalid.not_permission', FORBIDDEN_ERROR);
    }

    public static function applyOwnershipRestriction(array $permissionQuery = [], array $payload = [])
    {
        $session = session();
        $permissions =  PermissionsBusiness::getPermissionUserAuth($permissionQuery);

        if (count($permissions) === 0)
            $payload['owner_id'] = $session->get('userAuthId');

        return $payload;
    }

    /**
     * @return array{GroupPermissionsEntity}
     */
    public static function getPermissionUserAuth(array $permissionQuery = []): array
    {
        $session = \session();
        $userAuthId = $session->get('userAuthId');

        $groupsModel = new UsersGroupsModel();
        $groups = $groupsModel->where('user_id', $userAuthId)->findAll();

        $groupsPermissionsModel = new GroupsPermissionsModel();

        $foundPermissions = $groupsPermissionsModel->getGroupsWithPermissions([
            "in_ids" => \array_map(fn(UserGroupsEntity $userGroup) => $userGroup->getGroupId(), $groups)
        ], $permissionQuery);

        return $foundPermissions;
    }
}
