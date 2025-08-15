<?php

namespace App\Components\Private\Container;

use App\Components\BaseComponents;

class Container extends BaseComponents
{
    const ORIGIN = "components/private/container";
    const PROPS = [
        'content'
    ];

    public static function render(
        ?string $content = ""
    ) {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
