<?php

namespace App\Components\Private\Profile;

use App\Components\BaseComponents;

class Permissions extends BaseComponents
{
    const ORIGIN = "components/private/profile/permissions";
    const PROPS = [];

    public static function render()
    {
        return Component(SELF::ORIGIN, compact(SELF::PROPS), true);
    }
}
