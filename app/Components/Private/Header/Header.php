<?php

namespace App\Components\Private\Header;

use App\Components\BaseComponents;

class Header extends BaseComponents
{
    const ORIGIN = "components/private/header/index";
    const PROPS = [];

    public static function render()
    {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
