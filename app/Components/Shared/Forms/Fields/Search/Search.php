<?php

namespace App\Components\Shared\Forms\Fields\Search;

use App\Components\BaseComponents;

class Search extends BaseComponents
{
    const ORIGIN = "components/shared/forms/fields/search";
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
    ];

    public static function render(
        ?string $name = "",
        ?string $id = "",
        ?string $label = "",
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
