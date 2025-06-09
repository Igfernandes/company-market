<?php

namespace App\Business\Permissions;

use App\Business\BaseBusiness;
use App\Database\Entities\Permissions\GroupPermissionsEntity;
use App\Database\Entities\Users\GroupEntity;
use App\Database\Models\Permissions\GroupsPermissionsModel;
use App\Database\Models\Permissions\PermissionsModel;
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
    public function hasPermissions($permissions): bool
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

    public static function hasPermissionUserAuth(array $permissionQuery = [])
    {
        $permissions =  PermissionsBusiness::getPermissionUserAuth($permissionQuery);

        if (count($permissions) === 0)
            throw new Exceptions(\lang('Erros.not_permission'), \BAD_AUTH);
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
            "in_ids" => \array_map(fn(GroupEntity $group) => $group->getId(), $groups)
        ], $permissionQuery);

        return $foundPermissions;
    }
}
