<?php

namespace App\Components\Shared\Forms\Password\PasswordToggle;

use App\Components\BaseComponents;

class PasswordToggle extends BaseComponents
{
    const ORIGIN = "components/shared/forms/password/passwordToggle";
    const PROPS = [
        "name",
        "label",
        "id",
        "value",
        "placeholder",
        "className",
        "required",
        "attributes",
        "disabled",
        "readonly"
    ];

    public static function render(
        ?string $name = "",
        ?string $id = "",
        ?string $label = "",
        ?string $value = "",
        ?string $placeholder = "",
        ?string $className = "",
        ?string $required = "",
        ?array $attributes = [],
        ?bool $disabled = null,
        ?bool $readonly = null
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
