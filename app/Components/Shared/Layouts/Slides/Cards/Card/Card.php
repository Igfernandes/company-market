<?php

/**
 * Template de geração de componentes
 *
 * ⚠️ Este arquivo contém placeholders (ex: Card, App\Components\Shared\Layouts\Slides\Cards\Card) que
 * são substituídos dinamicamente pelo comando `php spark component:make`.
 *
 */

namespace App\Components\Shared\Layouts\Slides\Cards\Card;

use App\Components\BaseComponents;

class Card extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/slides/cards/card";
    const PROPS = [
        'icon',
        'title',
        'text'
    ];

    public static function render(
        ?string $icon = "",
        ?string $title = "",
        ?string $text = ""
    ) {
        return Component(self::ORIGIN, compact(self::PROPS), true);
    }
}
