<?php

namespace App\Components\Private\Clients\Categories;

use App\Components\BaseComponents;

class Form extends BaseComponents
{
    const ORIGIN = "components/private/clients/categories/form";
    const PROPS = [];

    public static function render()
    {
        return Component(SELF::ORIGIN, compact(SELF::PROPS), true);
    }
}
