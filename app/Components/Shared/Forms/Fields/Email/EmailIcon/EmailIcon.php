<?php

namespace App\Components\Shared\Forms\Fields\Email\EmailIcon;

use App\Components\BaseComponents;

class EmailIcon extends BaseComponents
{
    const ORIGIN = "components/shared/forms/fields/email/email-icon";
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
        "iconLeft",
        "iconRight"
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
        ?bool $iconLeft = null,
        ?bool $iconRight = null
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
