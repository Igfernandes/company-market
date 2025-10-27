<?php

/**
 * Template de geração de componentes
 *
 * ⚠️ Este arquivo contém placeholders (ex: BtnPrimary, App\Components\Shared\Layouts\Buttons\BtnPrimary) que
 * são substituídos dinamicamente pelo comando `php spark component:make`.
 *
 */

namespace App\Components\Shared\Layouts\Buttons\BtnPrimary;

use App\Components\BaseComponents;

class BtnPrimary extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/buttons/btnPrimary";
    const PROPS = [
        'link',
        'text'
    ];

    public static function render(
        ?string $link = "#",
        ?string $text = ""
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
