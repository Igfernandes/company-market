<?php

namespace App\Components\Shared\Layouts\Slides\Profile;

use App\Components\BaseComponents;

class Profile extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/slides/profile/index";
    const PROPS = [
        "id",
        "background",
        "fill",
        "items",
        "loop",
        "autoplay",
        "spaceBetween",
        "slidesPerView",
        "breakpoints"
    ];

    public static function render(string $id = "",
        ?array $items = [],
        ?string $background = "",
        ?string $fill = "",
        ?bool $loop = false,
        ?bool $autoplay = false,
        ?int $spaceBetween = 10,
        ?int $slidesPerView = 1,
        ?array $breakpoints = [])
    {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}