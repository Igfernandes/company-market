<?php

namespace App\Components\Shared\Forms\Fields\Button;

use App\Components\BaseComponents;

class Button extends BaseComponents
{
    const ORIGIN = "components/shared/forms/fields/button";
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
