<?php

namespace App\Components\Shared\Forms\Submit;

use App\Components\BaseComponents;

class Submit extends BaseComponents
{
    const ORIGIN = "components/shared/forms/submit";
    const PROPS = [
        "id",
        "text",
        "class",
        "attributes"
    ];

    public static function render(
        ?string $id = "",
        ?string $text = "",
        ?string $class = "",
        ?array $attributes = [],
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
