<?php

namespace App\Traits\Notifications;

use App\Database\Entities\Notifications\NotificationEntity;

trait NotificationsDataTrait
{
    public function notificationsResponse(NotificationEntity $notification): Object
    {
        $author =  $notification->getAuthor();

        return  (object)[
            "id"            => $notification->getId(),
            "title"         => $notification->getTitle(),
            "message"       => $notification->getMessage(),
            "operation"     => \strtolower($notification->getScope() . "_" . $notification->getAction()),
            "key"           => $notification->getKey(),
            "author"     => (object)[
                "id" => $author->getId(),
                "name" => $author->getName()
            ],
            "created_at" => $notification->getCreatedAt(),
        ];
    }
}
