<?php

namespace App\Components\Shared\Forms\Fields\Phone\Simple;

use App\Components\BaseComponents;

class Phone extends BaseComponents
{
    const ORIGIN = "components/shared/forms/fields/phone/simple";
    const PROPS = [
        "name",
        "label",
        "id",
        "code",
        "value",
        "class",
        "required",
        "attributes",
        "disabled",
        "readonly",
    ];

    public static function render(
        ?string $name = "",
        ?string $id = "",
        ?string $label = "",
        ?string $code = "br",
        ?string $type = "text",
        ?string $value = "",
        ?string $class = "",
        ?string $required = "",
        ?array $attributes = [],
        ?bool $disabled = null,
        ?bool $readonly = null
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
