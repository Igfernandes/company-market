<?php

namespace App\Components\Private\Features\MsgCenter;

use App\Components\BaseComponents;

class MsgCenter extends BaseComponents
{
    const ORIGIN = "components/private/features/msgCenter/index";
    const PROPS = [];

    public static function render()
    {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
