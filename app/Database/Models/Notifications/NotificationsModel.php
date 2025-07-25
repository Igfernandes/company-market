<?php

namespace App\Database\Models\Notifications;

use App\Database\Entities\Notifications\NotificationEntity;
use App\Database\Entities\Users\UserEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

class NotificationsModel extends Model
{
    use ModelTrait;

    protected $table            = 'notifications';
    protected $primaryKey       = 'id';
    protected $DBGroup          = 'default';

    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Database\Entities\Notifications\NotificationEntity';
    protected $protectFields    = true;

    protected $allowedFields = [
        'title',
        'message',
        'action',
        'scope',
        'key',
        'author_id'
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function getNotificationWithAuthor(array $notificationQuery = []): array
    {
        $notificationsQueryUpdated = $this->addPrefixInQuery($notificationQuery, "notifications");

        $founds = $this->select(" users.*, notifications.*, 
        users.name as user_name, users.id as user_id, users.created_at as user_created_at, 
        users.updated_at as user_updated_at,
        notifications.id as notification_id, notifications.created_at as notification_created_at")
            ->join("users", "users.id = notifications.author_id", "left")
            ->where($notificationsQueryUpdated)->findAll();

        return array_map(function (NotificationEntity $foundNotification) {
            $notification = new NotificationEntity();
            $userEntity = new UserEntity();

            /** @var array */
            $attributes = $foundNotification->attributes;

            if (isset($attributes['user_id'])) {
                $userEntity->store($attributes);
                $userEntity->setId($attributes['user_id']);
                $userEntity->setName($attributes['user_name']);
                $userEntity->setCreatedAt($attributes['user_created_at']);
                $userEntity->setUpdatedAt($attributes['user_updated_at']);
            }

            $notification->store($attributes);
            $notification->setAuthorId($attributes['user_id']);
            $notification->setId($attributes['notification_id']);
            $notification->setAuthor($userEntity);

            return $notification;
        }, $founds);
    }
}
