<?php

namespace App\Api\Operations\Users\Patch\Status;

use App\Business\Users\UsersBusiness;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Exceptions\Exceptions;

class PatchStatusUseCases
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
            throw new Exceptions("Api.users.invalid.not_found", \BAD_BUSINESS_RULES);

        $usersModel = new UsersModel();

        $foundUser =  $usersModel->where("id = $userId")->first();

        $statusUpdate = $foundUser->getStatus() === "ACTIVE" ? "INACTIVE" : "ACTIVE";

        $usersModel->set("status", $statusUpdate)->update($userId);

        return (object)[
            "success" => "Api.users.success.patch_status"
        ];
    }
}
