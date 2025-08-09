<?php

namespace App\Api\Operations\Users\Notifications\Get;

use App\Database\Entities\Notifications\UserNotificationEntity;
use App\Database\Models\Notifications\UsersNotificationsModel;
use App\Traits\BusinessTrait;
use App\Traits\Notifications\UsersNotificationsDataTrait;

class GetUseCases
{
    use BusinessTrait, UsersNotificationsDataTrait;

    /**
     * @param array{ 
     *     notification_id: int, 
     *     user_id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $usersNotificationsModel = new UsersNotificationsModel();

        $userQuery = [];
        $notificationQuery = [];

        if (isset($filteredPayload['user_id']))
            $userQuery = [
                "id" => $payload['user_id']
            ];
        if (isset($filteredPayload['notification_id']))
            $notificationQuery =  [
                "id" => $payload['notification_id']
            ];

        $foundNotifications = $usersNotificationsModel->getUsersWithNotifications($userQuery, $notificationQuery);

        return array_map(fn(UserNotificationEntity $userNotification) => $this->usersWithNotifications($userNotification), $foundNotifications);
    }
}
