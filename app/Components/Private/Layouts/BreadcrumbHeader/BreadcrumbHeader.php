<?php

namespace App\Components\Private\Layouts\BreadcrumbHeader;

use App\Components\BaseComponents;

class BreadcrumbHeader extends BaseComponents
{
    const ORIGIN = "components/private/layouts/breadcrumbHeader";
    const PROPS = [
        'title',
        'text',
        'icon'
    ];

    public static function render(
        ?string $title = "",
        ?string $text = "",
        ?string $icon = "",
        ?bool $isReturn = false
    ) {
        return Component(SELF::ORIGIN, compact(SELF::PROPS), $isReturn);
    }
}
