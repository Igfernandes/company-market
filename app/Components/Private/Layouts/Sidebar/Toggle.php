<?php

namespace App\Components\Private\Layouts\Sidebar;

use App\Components\BaseComponents;

class Toggle extends BaseComponents
{
    const ORIGIN = "components/private/layouts/sidebar/toggle";
    const PROPS = [];

    public static function render()
    {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
