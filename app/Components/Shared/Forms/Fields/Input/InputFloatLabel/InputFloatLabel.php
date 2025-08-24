<?php

namespace App\Components\Shared\Forms\Fields\Input\InputFloatLabel;

use App\Components\BaseComponents;

class InputFloatLabel extends BaseComponents
{
    const ORIGIN = "components/shared/forms/fields/input/input-float-label";
    const PROPS = [
        "name",
        "label",
        "id",
        "value",
        "type",
        "placeholder",
        "class",
        "required",
        "attributes",
        "disabled",
        "readonly",
        "icon"
    ];

    public static function render(
        ?string $name = "",
        ?string $id = "",
        ?string $label = "",
        ?string $type = "text",
        ?string $value = "",
        ?string $placeholder = "",
        ?string $class = "",
        ?string $required = "",
        ?array $attributes = [],
        ?bool $disabled = null,
        ?bool $readonly = null,
        ?string $icon = null
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
