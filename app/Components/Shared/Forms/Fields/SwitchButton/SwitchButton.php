<?php

namespace App\Components\Shared\Forms\Fields\SwitchButton;

use App\Components\BaseComponents;

class SwitchButton extends BaseComponents
{
    const ORIGIN = "components/shared/forms/fields/switch-button";
    const PROPS = [
        "name",
        "id",
        "left",
        "right",
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
        ?array $left = [],
        ?array $right = [],
        ?string $name = "",
        ?string $class = "",
        ?string $required = "",
        ?string $value = "",
        ?bool $disabled = null,
        ?bool $readonly = null,
        ?bool $checked = null,
        ?array $attributes = [],
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
