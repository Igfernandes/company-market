<?php

namespace App\Components\Private\Header;

use App\Components\BaseComponents;

class Translate extends BaseComponents
{
    const ORIGIN = "components/private/header/translate";
    const PROPS = [];

    public static function render()
    {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
