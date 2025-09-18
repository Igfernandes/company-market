<?php

namespace App\Components\Private\Users\Roles;

use App\Components\BaseComponents;

class Form extends BaseComponents
{
    const ORIGIN = "components/private/users/roles/form";
    const PROPS = [];

    public static function render()
    {
        return Component(SELF::ORIGIN, compact(SELF::PROPS), true);
    }
}
