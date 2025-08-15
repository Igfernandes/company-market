<?php

namespace App\Components\Private\Header;

use App\Components\BaseComponents;

class Settings extends BaseComponents
{
    const ORIGIN = "components/private/header/settings";
    const PROPS = [];

    public static function render()
    {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
