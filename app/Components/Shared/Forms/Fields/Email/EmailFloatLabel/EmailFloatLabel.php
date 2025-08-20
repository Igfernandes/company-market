<?php

namespace App\Components\Shared\Forms\Fields\Email\EmailFloatLabel;

use App\Components\BaseComponents;

class EmailFloatLabel extends BaseComponents
{
    const ORIGIN = "components/shared/forms/fields/email/email-float-label";
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
        "readonly",
        "icon",
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
        ?bool $readonly = null,
        ?string $icon = null
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
