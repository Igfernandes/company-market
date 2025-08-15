<?php

namespace App\Components\Private\Sidebar;

use App\Components\BaseComponents;

class Sidebar extends BaseComponents
{
    const ORIGIN = "components/private/sidebar/index";
    const PROPS = [];

    public static function render()
    {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
