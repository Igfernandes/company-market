<?php

namespace App\Components\Private\Profile;

use App\Components\BaseComponents;

class Form extends BaseComponents
{
    const ORIGIN = "components/private/profile/form";
    const PROPS = [];

    public static function render()
    {
        return Component(SELF::ORIGIN, compact(SELF::PROPS), true);
    }
}
