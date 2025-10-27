<?php

/**
 * Template de geração de componentes
 *
 * ⚠️ Este arquivo contém placeholders (ex: Cards, App\Components\Shared\Layouts\Slides\Cards) que
 * são substituídos dinamicamente pelo comando `php spark component:make`.
 *
 */

namespace App\Components\Shared\Layouts\Slides\Cards;

use App\Components\BaseComponents;

class Cards extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/slides/cards/index";
    const PROPS = [
        "id",
        "background",
        "fill",
        "cards",
        "loop",
        "autoplay",
        "spaceBetween",
        "slidesPerView",
        "breakpoints"
    ];

    public static function render(
        string $id = "",
        ?array $cards = [],
        ?string $background = "",
        ?string $fill = "",
        ?bool $loop = false,
        ?bool $autoplay = false,
        ?int $spaceBetween = 10,
        ?int $slidesPerView = 1,
        ?array $breakpoints = []
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
