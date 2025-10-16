<?php

namespace App\Api\Operations\Users\Patch\Status;

use App\Business\Users\UsersBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use CodeIgniter\HTTP\ResponseInterface;

class PatchStatusUseCases
{
    /**
     * @param array{
     *   id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $session = session();

        /** @var UserEntity */
        $userAuth = $session->get(SESSION_KEY_AUTH_USER);

        if (empty($userAuth))
            throw new Exceptions("Api.users.invalid.not_found", ResponseInterface::HTTP_NOT_FOUND);

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

        NotificationsService::store([
            "scope" => "users",
            "action" => "UPDATE"
        ]);


        return (object)[
            "success" => "Api.users.success.patch.status"
        ];
    }
}
