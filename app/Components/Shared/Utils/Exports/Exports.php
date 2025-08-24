<?php

namespace App\Components\Shared\Utils\Exports;

use App\Components\BaseComponents;

class Exports extends BaseComponents
{
    const ORIGIN = "components/shared/utils/exports";
    const PROPS = [
        'entity',
        'excel',
        'pdf'
    ];

    public static function render(
        ?string $entity = '',
        ?bool $excel = false,
        ?bool $pdf = false
    ) {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
