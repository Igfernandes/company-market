<?php

namespace App\Components\Shared\Forms\Fields\Date\DateIcon;

use App\Components\BaseComponents;

class DateIcon extends BaseComponents
{
    const ORIGIN = "components/shared/forms/fields/date/date-icon";
    const PROPS = [
        "name",
        "label",
        "id",
        "value",
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
        ?string $type = "text",
        ?string $value = "",
        ?string $class = "",
        ?string $required = "",
        ?array $attributes = [],
        ?bool $disabled = null,
        ?bool $readonly = null,
        ?string $iconLeft = null,
        ?string $iconRight = null
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
