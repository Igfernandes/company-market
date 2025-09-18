<?php

namespace App\Components\Shared\Forms\Fields\Textarea\TextareaFloatLabel;

use App\Components\BaseComponents;

class TextareaFloatLabel extends BaseComponents
{
    const ORIGIN = "components/shared/forms/fields/textarea/textarea-float-label";
    const PROPS = [
        "name",
        "label",
        "id",
        "value",
        "type",
        "placeholder",
        "class",
        "required",
        "attributes",
        "maxLength",
        "disabled",
        "readonly",
        "icon"
    ];

    public static function render(
        ?string $name = "",
        ?string $id = "",
        ?string $label = "",
        ?string $type = "text",
        ?string $value = "",
        ?string $placeholder = "",
        ?int $maxLength = 0,
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
