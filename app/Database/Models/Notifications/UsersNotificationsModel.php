<?php

namespace App\Database\Models\Notifications;

use App\Database\Entities\Notifications\NotificationEntity;
use App\Database\Entities\Notifications\UserNotificationEntity;
use App\Database\Entities\Users\UserEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class UsersNotificationsModel extends Model
{
    use ModelTrait;

    protected $table            = 'users_notifications';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $returnType       = 'App\Database\Entities\Notifications\UserNotificationEntity';

    protected $allowedFields = [
        'user_id',
        'notification_id'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';

    public function getUsersWithNotifications(array $userQuery, array $notificationQuery = []): array
    {
        $userQueryUpdated = $this->addPrefixInQuery($userQuery, "users");
        $notificationsQueryUpdated = $this->addPrefixInQuery($notificationQuery, "notifications");

        $founds = $this->select(" users.*, notifications.*, users_notifications.*,
        users.name as user_name, users.id as user_id, users.created_at as user_created_at, 
        users.updated_at as user_updated_at,
        notifications.id as notification_id, notifications.created_at as notification_created_at")
            ->join("users", "users.id = users_notifications.user_id")
            ->join("notifications", "notifications.id = users_notifications.notification_id")
            ->where($userQueryUpdated)
            ->where($notificationsQueryUpdated)->findAll();

        return array_map(function (UserNotificationEntity $clientDispatcherData) {
            $userNotification = new UserNotificationEntity();
            $userEntity = new UserEntity();
            $notificationEntity = new NotificationEntity();

            /** @var array */
            $attributes = $clientDispatcherData->attributes;

            $userEntity->store($attributes);
            $userEntity->setId($attributes['user_id']);
            $userEntity->setName($attributes['user_name']);
            $userEntity->setCreatedAt($attributes['user_created_at']);
            $userEntity->setUpdatedAt($attributes['user_updated_at']);

            $notificationEntity->store($attributes);
            $notificationEntity->setId($attributes['notification_id']);
            $notificationEntity->setCreatedAt($attributes['notification_created_at']);

            $userNotification->store($attributes);
            $userNotification->setUserId($attributes['user_id']);
            $userNotification->setNotificationId($attributes['notification_id']);
            $userNotification->setUser($userEntity);
            $userNotification->setNotification($notificationEntity);

            return $userNotification;
        }, $founds);
    }
}
