<?php

namespace App\Components\Shared\Forms\Variants\GroupValidations;

use App\Components\BaseComponents;

class GroupValidations extends BaseComponents
{
    const ORIGIN = "components/shared/forms/variants/groupValidations";
    const PROPS = [
        "name",
        "label",
        "id",
        "class",
        "required"
    ];

    public static function render(
        ?string $name = "",
        ?string $id = "",
        ?string $label = "",
        ?string $class = "",
        ?string $required = ""
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}