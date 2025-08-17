<?php

namespace App\Database\Models\Notifications;

use App\Database\Entities\Notifications\NotificationEntity;
use App\Database\Entities\Users\UserEntity;
use App\Traits\ModelTrait;
use CodeIgniter\Model;

/**
 * @method NotificationEntity|null find($id = null)
 * @method NotificationEntity|null first()
 * @method NotificationEntity[]|null findAll($limit = 0, $offset = 0)
 */
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
        if (isset($notificationQuery['in_ids'])) {
            $this->whereIn("notifications.id", $notificationQuery['in_ids']);
            unset($notificationQuery['in_ids']);
        }

        if (isset($notificationQuery['in_action']) && isset($notificationQuery['in_scope'])) {
            $builder = $this->builder(); // ou $this->builder() se estiver no Model

            $builder->groupStart();
            foreach ($notificationQuery['in_action'] as $index => $actions) {
                $scope = $notificationQuery['in_scope'][$index];

                if (empty($scope)) continue;

                $builder->orGroupStart()
                    ->where('notifications.scope', $notificationQuery['in_scope'][$index])
                    ->where('notifications.action', $actions)
                    ->groupEnd();
            }
            $builder->groupEnd();

            unset($notificationQuery['in_action']);
            unset($notificationQuery['in_scope']);
        }

        $notificationsQueryUpdated = $this->addPrefixInQuery($notificationQuery, "notifications");

        $this->select("users.*, notifications.*, 
        users.name as user_name, users.id as user_id, users.created_at as user_created_at, 
        users.updated_at as user_updated_at,
        notifications.id as notification_id, notifications.created_at as notification_created_at")
            ->join("users", "users.id = notifications.author_id")
            ->where($notificationsQueryUpdated);


        $founds = $this->findAll();


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
