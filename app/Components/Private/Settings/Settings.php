<?php

namespace App\Components\Private\Settings;

use App\Components\BaseComponents;

class Settings extends BaseComponents
{
    const ORIGIN = "components/private/settings/index";
    const PROPS = [];

    public static function render()
    {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
