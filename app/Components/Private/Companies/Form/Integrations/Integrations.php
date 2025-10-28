<?php

namespace App\Components\Private\Companies\Form\Integrations;

use App\Components\BaseComponents;

class Integrations extends BaseComponents
{
    const ORIGIN = "components/private/companies/form/integrations/index";
    const PROPS = [
        'isReturn'
    ];

    public static function render(
        ?bool $isReturn = false
    ) {
        return Component(SELF::ORIGIN, compact(SELF::PROPS), $isReturn);
    }
}
