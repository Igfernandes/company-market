<?php

namespace App\Business\Permissions;

use App\Database\Entities\Permissions\PermissionEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Entities\Users\UserRoleEntity;
use App\Database\Models\Permissions\PermissionsModel;
use App\Database\Models\Users\UsersRolesModel;

class PermissionsSearchBusiness
{
    /**
     * Obtém todas as permissões do usuário autenticado (com base na sessão)
     *
     * @return PermissionEntity[]
     */
    public static function getPermissionUserAuth(array $permissionQuery = []): array
    {
        $session = session();
        /** @var UserEntity */
        $userAuth = $session->get(SESSION_KEY_AUTH_USER);

        if (!$userAuth) {
            return [];
        }

        $userId = $userAuth->getId();

        // delega para o método genérico
        return static::getPermissions($userId, $permissionQuery);
    }

    /**
     * Obtém todas as permissões com base em um usuário específico e seus roles
     *
     * @param int $userId
     * @param array $permissionQuery
     * @return PermissionEntity[]
     */
    public static function getPermissions(int $userId, array $permissionQuery = []): array
    {
        $permissionsModel = new PermissionsModel();

        if (!empty($permissionQuery)) {
            $permissionsModel->where($permissionQuery);
        }

        $usersRolesModel = new UsersRolesModel();
        $foundRoles = $usersRolesModel->where('user_id', $userId)->findAll();
        $roleIds = array_map(fn(UserRoleEntity $role) => $role->getRoleId(), $foundRoles);

        $permissionsModel
            ->select('permissions.*')
            ->join('users_permissions up', 'up.permission_id = permissions.id AND up.user_id = ' . (int)$userId, 'left');

        if (!empty($roleIds)) {
            $permissionsModel
                ->join('roles_permissions rp', 'rp.permission_id = permissions.id', 'left')
                ->whereIn('rp.role_id', $roleIds);
        }

        $foundPermissions = $permissionsModel
            ->orWhere('up.user_id', $userId)
            ->findAll();

        $uniquePermissions = array_values(array_reduce($foundPermissions, function ($carry, $permission) {
            $carry[$permission->getId()] = $permission;
            return $carry;
        }, []));

        return $uniquePermissions;
    }


    /**
     * Retorna as permissões agrupadas por escopo
     *
     * @return array<string, array<PermissionEntity>>
     */
    public static function getScoped(): array
    {
        $permissionsByGroup = [];
        $permissions = static::getPermissionUserAuth();

        foreach ($permissions as $permission) {
            $permissionsByGroup[$permission->getScope()][] = $permission->toArray();
        }

        return $permissionsByGroup;
    }
}
