<?php

namespace App\Components\Private\Profile;

use App\Components\BaseComponents;

class Content extends BaseComponents
{
    const ORIGIN = "components/private/profile/content";
    const PROPS = [];

    public static function render()
    {
        return Component(SELF::ORIGIN, compact(SELF::PROPS), true);
    }
}
