<?php

namespace App\Components\Shared\Layouts\Image;

use App\Components\BaseComponents;

class Image extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/image";
    const PROPS = [
        "src",
        "alt",
        "class",
        "attributes",
        "default"
    ];

    public static function render(
        ?string $class = "",
        ?string $src = "",
        ?string $alt = "",
        ?string $default = "",
        ?array $attributes = [],
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
