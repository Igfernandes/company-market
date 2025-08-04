<?php

namespace App\Components\Shared\Layouts\Head;

use App\Components\BaseComponents;

class Head extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/head";
    const PROPS = [
        "title",
        "description",
        "path",
        "hasTable"
    ];

    public static function render(
        ?string $title = "",
        ?string $description = "",
        ?string $path = "",
        ?bool $hasTable = false
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
