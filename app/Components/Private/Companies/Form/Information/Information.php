<?php

namespace App\Components\Private\Companies\Form\Information;

use App\Components\BaseComponents;

class Information extends BaseComponents
{
    const ORIGIN = "components/private/companies/form/information/index";
    const PROPS = [
        'isReturn'
    ];

    public static function render(
        ?bool $isReturn = false
    ) {
        return Component(SELF::ORIGIN, compact(SELF::PROPS), $isReturn);
    }
}
