<?php

namespace App\Components\Shared\Forms\Fields\Checkbox;

use App\Components\BaseComponents;

class Checkbox extends BaseComponents
{
    const ORIGIN = "components/shared/forms/field/checkbox";
    const PROPS = [
        "name",
        "id",
        "label",
        "class",
        "required",
        "attributes",
        "disabled",
        "readonly",
        "value",
        "checked"
    ];

    public static function render(
        ?string $id = "",
        ?string $label = "",
        ?string $name = "",
        ?string $class = "",
        ?string $required = "",
        ?string $value = "1",
        ?bool $disabled = null,
        ?bool $readonly = null,
        ?bool $checked = null,
        ?array $attributes = [],
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
