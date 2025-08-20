<?php

namespace App\Components\Private\Layouts\Settings;

use App\Components\BaseComponents;

class Settings extends BaseComponents
{
    const ORIGIN = "components/private/layouts/settings/index";
    const PROPS = [];

    public static function render()
    {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
