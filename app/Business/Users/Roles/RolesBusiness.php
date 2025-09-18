<?php

namespace App\Business\Users\Roles;

use App\Business\BaseBusiness;
use App\Database\Models\Users\UsersModel;
use App\Database\Models\Users\UsersRolesModel;
use App\Traits\Users\UsersDataTrait;

class RolesBusiness
{
    use BaseBusiness, UsersDataTrait;

    private UsersModel $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public static function hasUsers(int $userId = 0, int $roleId = 0): bool
    {
        $usersRolesModel = new UsersRolesModel();
        $query = [];

        if ($userId > 0)
            $query['user_id'] = $userId;
        if ($roleId > 0)
            $query['role_id'] = $roleId;

        $found = $usersRolesModel->where($query)->find();

        return !empty($found);
    }
}
