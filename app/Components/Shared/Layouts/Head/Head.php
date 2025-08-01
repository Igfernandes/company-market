<?php

namespace App\Components\Shared\Layouts\Head;

use App\Components\BaseComponents;

class Head extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/head";
    const PROPS = [
        "title",
        "description",
        "path"
    ];

    public static function render(
        ?string $title = "",
        ?string $description = "",
        ?string $path = "",
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
