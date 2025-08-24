<?php

namespace App\Components\Private\Users\Overview;

use App\Components\BaseComponents;

class Content extends BaseComponents
{
    const ORIGIN = "components/private/users/overview/content";
    const PROPS = [];

    public static function render()
    {
        return Component(SELF::ORIGIN, compact(SELF::PROPS), true);
    }
}
