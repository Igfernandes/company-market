<?php

namespace App\Components\Shared\Forms\Fields\Date\DateFloatLabel;

use App\Components\BaseComponents;

class DateFloatLabel extends BaseComponents
{
    const ORIGIN = "components/shared/forms/fields/date/date-float-label";
    const PROPS = [
        "name",
        "label",
        "id",
        "value",
        "required",
        "attributes",
        "disabled",
        "readonly",
        "placeholder"
    ];

    public static function render(
        ?string $name = "",
        ?string $id = "",
        ?string $label = "",
        ?string $value = "",
        ?string $required = "",
        ?string $placeholder = "",
        ?array $attributes = [],
        ?bool $disabled = null,
        ?bool $readonly = null,
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
