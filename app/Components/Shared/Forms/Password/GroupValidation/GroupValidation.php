<?php

namespace App\Components\Shared\Forms\Password\GroupValidation;

use App\Components\BaseComponents;

class GroupValidation extends BaseComponents
{
    const ORIGIN = "components/shared/forms/password/groupValidation";
    const PROPS = [
        "name",
        "id",
        "class",
        "required"
    ];

    public static function render(
        ?string $name = "",
        ?string $id = "",
        ?string $class = "",
        ?string $required = ""
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}