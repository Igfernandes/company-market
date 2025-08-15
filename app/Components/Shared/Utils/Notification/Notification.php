<?php

namespace App\Components\Shared\Utils\Notification;

use App\Components\BaseComponents;

class Notification extends BaseComponents
{
    const ORIGIN = "components/shared/utils/notification/index";
    const PROPS = [];

    public static function render()
    {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
