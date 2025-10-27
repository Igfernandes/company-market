<?php

namespace App\Components\Shared\Layouts\Collapse;

use App\Components\BaseComponents;

class Collapse extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/collapse";
    const PROPS = [
        "id",
        "contents",
        "default"
    ];

    public static function render(?string $id = "",
        array $contents = [],
        ?string $default = "",
        bool $isReturn = false)
    {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}