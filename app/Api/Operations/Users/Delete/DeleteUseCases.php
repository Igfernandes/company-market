<?php

namespace App\Api\Operations\Users\Delete;

use App\Business\Users\UsersBusiness;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;

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
            throw new Exceptions("Api.users.invalid.not_found", \BAD_BUSINESS_RULES);

        $usersModel = new UsersModel();

        $usersModel->delete($userId);

        NotificationsService::store([
            "scope" => "users",
            "action" => "DELETE"
        ]);
        return (object)[
            "success" => "Api.users.success.delete"
        ];
    }
}
