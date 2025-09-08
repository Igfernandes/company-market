<?php

namespace App\Api\Operations\Users\Trash\Post;

use App\Business\Users\UsersBusiness;
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
use CodeIgniter\HTTP\ResponseInterface;

class PostUseCases
{

    /**
     * @param array{
     *   in_ids: int
     * } $payload
     */
    public function execute(array $payload)
    {

        if (!is_array($payload['in_ids']))
            throw new Exceptions('Api.users.trash.post.invalid.user_ids', ResponseInterface::HTTP_BAD_REQUEST);

        $usersModel = new UsersModel();
        $ids = $payload['in_ids'] ?? [];

        if (! empty($ids)) {
            $usersModel
                ->whereIn('id', $ids)
                ->set(['deleted_at' => null])
                ->update();
        }

        NotificationsService::store([
            "scope" => "users",
            "action" => "DELETE"
        ]);
        return (object)[
            "success" => "Api.users.success.trash.restore"
        ];
    }
}
