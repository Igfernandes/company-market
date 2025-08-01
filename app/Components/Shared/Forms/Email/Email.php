<?php

namespace App\Components\Shared\Forms\Email;

use App\Components\BaseComponents;

class Email extends BaseComponents
{
    const ORIGIN = "components/shared/forms/email";
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
        "readonly",
        "icon"
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
        ?bool $readonly = null,
        ?string $icon = null
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
