<?php

namespace App\Components\Shared\Forms\Fields\Date\DateInput;

use App\Components\BaseComponents;

class DateInput extends BaseComponents
{
    const ORIGIN = "components/shared/forms/fields/date/date-input";
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
        ?string $type = "text",
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
