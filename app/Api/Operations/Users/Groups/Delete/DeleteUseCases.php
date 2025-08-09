<?php

namespace App\Api\Operations\Users\Groups\Delete;

use App\Business\Users\Groups\GroupsBusiness;
use App\Database\Models\Permissions\GroupsPermissionsModel;
use App\Database\Models\Users\GroupsModel;
use App\Database\Models\Users\UsersGroupsModel;
use App\Libraries\Exceptions\Exceptions;

class DeleteUseCases
{
    /**
     * @param array{
     *   id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $groupsBusiness = new GroupsBusiness();

        $groupId = $payload['id'];

        if (!$groupsBusiness->hasGroup([
            "id" => $groupId
        ]))
            throw new Exceptions("Api.users.users.invalid.not_found", \BAD_BUSINESS_RULES);


        $groupsPermissionsModel = new GroupsPermissionsModel();
        $usersGroupsModel = new UsersGroupsModel();
        $groupsModel = new GroupsModel();
        $queryString = "group_id = $groupId";

        $groupsPermissionsModel->where($queryString)->delete();
        $usersGroupsModel->where($queryString)->delete();
        $groupsModel->delete($groupId);


        return (object)[
            "success" => "Api.users.groups.success.delete"
        ];
    }
}
