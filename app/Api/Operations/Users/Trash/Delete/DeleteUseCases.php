<?php

namespace App\Api\Operations\Users\Trash\Delete;

use App\Business\Users\UsersBusiness;
use App\Database\Migrations\UsersAuthHistory;
use App\Database\Models\Notifications\UsersNotificationsModel;
use App\Database\Models\Permissions\UsersPermissionsModel;
use App\Database\Models\SettingsPrivacy\UsersSettingsPrivacyModel;
use App\Database\Models\Users\UsersAuthHistoryModel;
use App\Database\Models\Users\UsersFieldsModel;
use App\Database\Models\Users\UsersModel;
use App\Database\Models\Users\UsersRolesModel;
use App\Database\Models\Users\UsersTokensModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;

class DeleteUseCases
{
    const USERS_REFERENCES_CLASS = [
        UsersFieldsModel::class,
        UsersTokensModel::class,
        UsersAuthHistoryModel::class,
        UsersPermissionsModel::class,
        UsersNotificationsModel::class,
        UsersSettingsPrivacyModel::class,
        UsersRolesModel::class
    ];

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

        foreach (SELF::USERS_REFERENCES_CLASS as $instances) {
            $model = new $instances();

            $model->where("user_id", $userId)->delete();
        }

        $usersModel->withDeleted()->delete($userId, true);

        NotificationsService::store([
            "scope" => "users",
            "action" => "DELETE"
        ]);
        return (object)[
            "success" => "Api.users.success.trash.delete"
        ];
    }
}
