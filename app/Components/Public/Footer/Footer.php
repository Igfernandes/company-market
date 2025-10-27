<?php

namespace App\Components\Public\Footer;

use App\Components\BaseComponents;

class Footer extends BaseComponents
{
    const ORIGIN = "components/public/footer";
    const PROPS = [
        'hasWhatsAppBtn'
    ];

    public static function render(
        ?bool $hasWhatsAppBtn = false
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
