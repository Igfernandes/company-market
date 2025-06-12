<?php

namespace App\Business\Users\Groups;

use App\Business\BaseBusiness;
use App\Database\Entities\Users\GroupEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Permissions\GroupsPermissionsModel;
use App\Database\Models\Users\GroupsModel;
use App\Database\Models\Users\UsersModel;
use App\Traits\Users\UsersDataTrait;

class GroupsBusiness
{
    use BaseBusiness, UsersDataTrait;

    private UsersModel $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     name: string, 
     *     name_contains: string, 
     *     descriptions_contains: string,  
     *     status: 'ACTIVE' | 'INACTIVE', 
     *     created_at: string, 
     *     updated_at: string 
     * } $payload
     */
    public function handler($payload): array
    {
        $groupEntity = new GroupEntity();
        $groupsPermissionsModel = new GroupsPermissionsModel();

        $groupEntity->fill($payload);

        $foundUserGroup = $groupsPermissionsModel->getGroupsWithPermissions($groupEntity->toArray(true));
        /** @var array{UserEntity} */
        $users = [];

        foreach ($foundUserGroup as $userGroup) {
            $users[$userGroup->getUserId()] = $userGroup->getUser();
        }

        return \array_values(array_map(fn($userEntity) => $this->builder($userEntity, $foundUserGroup), $users));
    }


    public function hasGroup($query): bool
    {
        $groupModel = new GroupsModel();

        $foundGroup = $groupModel->where($query)->find();

        return !empty($foundGroup);
    }
}
