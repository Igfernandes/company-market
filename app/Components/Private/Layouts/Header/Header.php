<?php

namespace App\Components\Private\Layouts\Header;

use App\Components\BaseComponents;

class Header extends BaseComponents
{
    const ORIGIN = "components/private/layouts/header/index";
    const PROPS = [];

    public static function render()
    {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
