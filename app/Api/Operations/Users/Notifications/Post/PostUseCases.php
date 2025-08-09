<?php

namespace App\Api\Operations\Users\Notifications\Post;

use App\Business\Permissions\PermissionsBusiness;
use App\Database\Entities\Notifications\NotificationEntity;
use App\Database\Entities\Notifications\UserNotificationEntity;
use App\Database\Models\Notifications\NotificationsModel;
use App\Database\Models\Notifications\UsersNotificationsModel;

class PostUseCases
{

    public function execute()
    {
        $session = session();
        $userAuthId = $session->get('userAuthId');

        $groupsPermissions = PermissionsBusiness::getPermissionUserAuth();

        $scopes = [];
        $actions = [];

        foreach ($groupsPermissions as $groupPermission) {
            $permission = $groupPermission->getPermission();
            \array_push($scopes, $permission->getScope());
            \array_push($actions, $permission->getType());
        }

        $usersNotificationsModel = new UsersNotificationsModel();
        $notificationsModel = new NotificationsModel();

        $notifications = $notificationsModel->whereIn("scope", $scopes)
            ->whereIn("action", $actions)->findAll();

        $foundNotifications = $usersNotificationsModel->where("user_id", $userAuthId)->findAll();
        $notificationIdsAlreadySaved = \array_map(fn(UserNotificationEntity $userNotification) => $userNotification->getNotificationId(), $foundNotifications);

        $notificationsNotSaved = [];
        /** @var NotificationEntity */
        foreach ($notifications as $notification) {
            if (array_search($notification->getId(), $notificationIdsAlreadySaved) !== false)
                continue;

            \array_push($notificationsNotSaved, [
                "user_id" => $userAuthId,
                "notification_id" => $notification->getId()
            ]);
        }

        if (\count($notificationsNotSaved) > 0)
            $usersNotificationsModel->insertBatch($notificationsNotSaved);

        return (object)[
            "success" => "Api.notifications.success.post"
        ];
    }
}
