<?php

namespace App\Components\Shared\Forms\Password\GroupValidation;

use App\Components\BaseComponents;

class GroupValidation extends BaseComponents
{
    const ORIGIN = "components/shared/forms/password/groupValidation";
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
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
