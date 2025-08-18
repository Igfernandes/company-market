<?php

namespace App\Components\Shared\Forms\Fields\Password;

use App\Components\BaseComponents;

class Password extends BaseComponents
{
    const ORIGIN = "components/shared/forms/fields/password";
    const PROPS = [
        "name",
        "label",
        "id",
        "value",
        "placeholder",
        "class",
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
        ?string $class = "",
        ?string $required = "",
        ?array $attributes = [],
        ?bool $disabled = null,
        ?bool $readonly = null
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
