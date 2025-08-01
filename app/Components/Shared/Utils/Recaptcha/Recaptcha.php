<?php

namespace App\Components\Shared\Utils\Recaptcha;

use App\Components\BaseComponents;

class Recaptcha extends BaseComponents
{
    const ORIGIN = "components/shared/utils/recaptcha";
    const PROPS = [];

    public static function render()
    {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
