<?php

namespace App\Components\Private\Layouts\Container;

use App\Components\BaseComponents;

class Container extends BaseComponents
{
    const ORIGIN = "components/private/layouts/container";
    const PROPS = [
        'head',
        'content'
    ];

    public static function render(
        ?array $head = [],
        ?array $content = []
    ) {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
