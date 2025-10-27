<?php

namespace App\Components\Private\Clients\Form\Information;

use App\Components\BaseComponents;

class Information extends BaseComponents
{
    const ORIGIN = "components/private/clients/form/information/index";
    const PROPS = [
        'isReturn'
    ];

    public static function render(
        ?bool $isReturn = false
    ) {
        return Component(SELF::ORIGIN, compact(SELF::PROPS), $isReturn);
    }
}
