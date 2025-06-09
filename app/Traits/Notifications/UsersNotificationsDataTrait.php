<?php

namespace App\Traits\Notifications;

use App\Database\Entities\Notifications\UserNotificationEntity;

trait UsersNotificationsDataTrait
{
    public function usersWithNotifications(UserNotificationEntity $userNotification): Object
    {
        return  (object)[
            "user_id"       => $userNotification->getUserId(),
            "user_name"     => $userNotification->getUser()->getName(),
            "notification_id"  => $userNotification->getNotification(),
            "notification"   => $userNotification->getNotification()->getTitle(),
            "created_at"      => $userNotification->getCreatedAt()
        ];
    }
}
