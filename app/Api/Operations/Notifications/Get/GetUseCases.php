<?php

namespace App\Api\Operations\Notifications\Get;

use App\Business\Permissions\PermissionsBusiness;
use App\Database\Entities\Notifications\NotificationEntity;
use App\Database\Models\Notifications\NotificationsModel;
use App\Traits\BusinessTrait;
use App\Traits\Notifications\NotificationsDataTrait;

class GetUseCases
{
    use BusinessTrait, NotificationsDataTrait;

    /**
     * @param array{ 
     *     id: int,
     *     in_ids: array<int>, 
     *     author_id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        helper('array');
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $permissions = PermissionsBusiness::getPermissionUserAuth();

        $scopes = [];
        $actions = [];

        foreach ($permissions as $permission) {
            if (empty($permission)) continue;

            array_push($scopes, $permission->getScope());
            array_push($actions, $permission->getType());
        }

        if (count($actions) == 0 && count($scopes) == 0) return [];

        $notificationEntity = new NotificationEntity();
        $notificationEntity->store($filteredPayload);

        $notificationQueries = $notificationEntity->toArray(true);
        if (isset($filteredPayload['in_ids'])) {
            $notificationQueries['in_ids'] = getOnlyNumbers($filteredPayload['in_ids']);
        }

        $notificationQueries['in_scope'] = $scopes;
        $notificationQueries['in_action'] = $actions;

        $notificationsModel = new NotificationsModel();
        /** @var array{NotificationEntity} $foundNotifications */
        $foundNotifications = $notificationsModel->getNotificationWithAuthor($notificationQueries);

        return array_map(fn(NotificationEntity $notification) => $this->notificationsResponse($notification), $foundNotifications);
    }
}
