<?php

namespace App\Api\Users\Delete;

use App\Business\Users\Groups\GroupsBusiness;
use App\Business\Users\UsersBusiness;
use App\Database\Models\Fields\UsersFieldsModel;
use App\Database\Models\Permissions\GroupsPermissionsModel;
use App\Database\Models\Users\GroupsModel;
use App\Database\Models\Users\UsersGroupsModel;
use App\Database\Models\Users\UsersModel;
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
        $usersBusiness = new UsersBusiness();

        $userId = $payload['id'];

        if (!$usersBusiness->hasUser([
            "id" => $userId
        ]))
            throw new Exceptions(\str_replace("{field}", lang("Words.user"), lang("Validation.not_found")), \BAD_BUSINESS_RULES);

        $usersFieldsModel = new UsersFieldsModel();
        $usersGroupsModel = new UsersGroupsModel();
        $usersModel = new UsersModel();
        $queryString = "user_id = $userId";

        $usersGroupsModel->where($queryString)->delete();
        $usersFieldsModel->where($queryString)->delete();
        $usersModel->delete($userId);

        return (object)[
            "success" => lang("Api.users.success.delete")
        ];
    }
}
