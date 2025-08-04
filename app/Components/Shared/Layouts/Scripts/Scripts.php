<?php

namespace App\Components\Shared\Layouts\Scripts;

use App\Components\BaseComponents;

class Scripts extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/scripts";
    const PROPS = [
        'scripts',
        'hasTable'
    ];

    public static function render(?array $scripts = [], ?bool $hasTable = false)
    {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
