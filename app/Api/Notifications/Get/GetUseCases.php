<?php

namespace App\Api\Notifications\Get;

use App\Business\Permissions\PermissionsBusiness;
use App\Database\Entities\Notifications\NotificationEntity;
use App\Database\Entities\Permissions\PermissionEntity;
use App\Database\Models\Notifications\NotificationsModel;
use App\Traits\BusinessTrait;

class GetUseCases
{
    use BusinessTrait;

    /**
     * @param array{ 
     *     id: int,
     *     in_ids: array<int>, 
     *     author_id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $notificationsModel = new NotificationsModel();
        $notificationEntity = new NotificationEntity();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        $notificationsModel = $this->builderClauseWithContains($filteredPayload ?? [], $notificationsModel);

        if (count($in_ids) > 0)
            $notificationsModel->whereIn("id", $in_ids);

        $groupsPermissions = PermissionsBusiness::getPermissionUserAuth();

        $scopes = [];
        $types = [];

        foreach ($groupsPermissions as $groupPermission) {
            $permission = $groupPermission->getPermission();
            if (empty($permission)) continue;

            array_push($scopes, $permission->getScope());
            array_push($types, $permission->getType());
        }
        if (count($types) == 0 && count($scopes) == 0) return [];

        $notificationsModel->whereIn("scope", $scopes);
        $notificationsModel->whereIn("type", $types);

        $notificationEntity->store($filteredPayload);
        /** @var array{CategoryEntity}*/
        $foundNotifications = $notificationsModel->where($notificationEntity->toArray())->findAll();

        return array_map(fn(PermissionEntity $notification) => $notification->toArray(), $foundNotifications);
    }
}
