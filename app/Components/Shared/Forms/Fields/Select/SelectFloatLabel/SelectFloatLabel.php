<?php

namespace App\Components\Shared\Forms\Fields\Select\SelectFloatLabel;

use App\Components\BaseComponents;

class SelectFloatLabel extends BaseComponents
{
    const ORIGIN = "components/shared/forms/fields/select/select-float-label";
    const PROPS = [
        "name",
        "label",
        "id",
        "value",
        "options",
        "class",
        "required",
        "attributes",
        "disabled",
        "readonly",
        "icon"
    ];

    /**
     * @param array{array{
     * text: string,
     *  value: string
     * }} $options
     */
    public static function render(
        ?string $name = "",
        ?string $id = "",
        ?string $label = "",
        ?array $options = [],
        ?string $value = "",
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
