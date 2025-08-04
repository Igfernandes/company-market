<?php

namespace App\Components\Shared\Layouts\Link;

use App\Components\BaseComponents;

class Link extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/link";
    const PROPS = [
        "text",
        "id",
        "href",
        "class",
    ];

    public static function render
    (
        ?string $text = "",
        ?string $id = "",
        ?string $href = "",
        ?string $class = "",
    ) {
        {
            Component(self::ORIGIN, compact(self::PROPS));
        }
    }
}