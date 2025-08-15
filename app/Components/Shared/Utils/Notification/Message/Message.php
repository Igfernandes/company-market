<?php

namespace App\Components\Shared\Utils\Notification\Message;

use App\Components\BaseComponents;

class Message extends BaseComponents
{
    const ORIGIN = "components/shared/utils/notification/message";
    const PROPS = [
        'author',
        'message',
        'datetime'
    ];

    public static function render(
        ?string $author = "",
        string $message = "",
        string $datetime = "",
    ) {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
