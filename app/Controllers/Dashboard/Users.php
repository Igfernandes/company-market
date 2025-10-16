<?php

namespace App\Controllers\Dashboard;

use App\Business\Permissions\PermissionsSearchBusiness;
use App\Controllers\BaseController;
use App\Database\Models\Permissions\UsersPermissionsModel;
use App\Database\Models\Users\RolesModel;
use App\Database\Models\Users\UsersModel;
use CodeIgniter\Files\Exceptions\FileNotFoundException;
use Exception;

class Users extends BaseController
{
    public function index()
    {
        $rolesModels = new RolesModel();
        $foundRoles = $rolesModels->findAll();

        $roleOptions = [
            null => "--"
        ];
        foreach ($foundRoles as $role) {
            $roleOptions[$role->getId()] = \ucfirst(lang("Words." . strtolower($role->getName())));
        }

        return view("layouts/dashboard/users/index", [
            "roles" => $roleOptions
        ]);
    }

    public function profile(string $id)
    {
        if (!is_numeric($id))
            throw new FileNotFoundException();

        $usersModel = new UsersModel();
        $usersPermissionsModel = new UsersPermissionsModel();

        $found = $usersModel->where("id", $id)->first();
        $permissions = PermissionsSearchBusiness::getScoped();

        $usersPermissions = $usersPermissionsModel->where("user_id", $id)->findAll();
        $permissionIds = \array_map(fn($permission) => $permission->getPermissionId(), $usersPermissions);

        $permissions = \array_map(
            fn($permissionScope) => array_map(function (array $permission) use ($permissionIds) {
                if (\array_search($permission['id'], $permissionIds) !== false)
                    $permission['checked'] = true;

                return $permission;
            }, $permissionScope),
            $permissions
        );

        if (empty($found))
            return redirect()->back()->with('failed', 'O usuário encontra-se com problemas ou inexistente no sistema. Entre em contato com suporte.');

        return view("layouts/dashboard/profile/index", [
            "user" => $found,
            "permissions" => $permissions,
            "id" => $id
        ]);
    }

    public function invites()
    {
        $rolesModels = new RolesModel();
        $foundRoles = $rolesModels->findAll();

        $roleOptions = [
            null => "--"
        ];
        foreach ($foundRoles as $role) {
            $roleOptions[$role->getId()] = \ucfirst(lang("Words." . strtolower($role->getName())));
        }

        return view("layouts/dashboard/users/invites", [
            "roles" => $roleOptions
        ]);
    }

    public function trash()
    {
        return view("layouts/dashboard/users/trash");
    }

    public function roles()
    {
        return view("layouts/dashboard/users/roles");
    }
}
