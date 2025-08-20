<?php

namespace App\Components\Private\Layouts\Header;

use App\Components\BaseComponents;

class Translate extends BaseComponents
{
    const ORIGIN = "components/private/layouts/header/translate";
    const PROPS = [];

    public static function render()
    {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
