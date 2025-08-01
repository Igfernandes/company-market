<?php

namespace App\Components\Shared\Layouts\Carousel;

use App\Components\BaseComponents;

class Carousel extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/carousel";
    const PROPS = [
        "spaceBetween",
        "effect",
        "slides",
        "class"
    ];

    public static function render(
        ?string $class = "",
        ?int $spaceBetween = 30,
        ?string $effect = "",
        ?array $slides = []
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
