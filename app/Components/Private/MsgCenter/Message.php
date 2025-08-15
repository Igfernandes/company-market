<?php

namespace App\Components\Private\MsgCenter;

use App\Components\BaseComponents;

class Message extends BaseComponents
{
    const ORIGIN = "components/private/msgCenter/message";
    const PROPS = [];

    public static function render()
    {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
