<?php

namespace App\Components\Private\Layouts\Header;

use App\Components\BaseComponents;

class Settings extends BaseComponents
{
    const ORIGIN = "components/private/layouts/header/settings";
    const PROPS = [];

    public static function render()
    {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
