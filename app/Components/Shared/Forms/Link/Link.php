<?php

namespace App\Components\Shared\Forms\Link;

use App\Components\BaseComponents;

class Link extends BaseComponents
{
    const ORIGIN = "components/shared/forms/link";
    const PROPS = [
        "name",
        "label",
        "id",
        "href",
        "readonly",
        "className",
    ];

    public static function render
    (
        ?string $name = "",
        ?string $label = "",
        ?string $id = "",
        ?string $href = "",
        ?bool $readonly = null,
        ?string $className = "",
    ) {
        {
            Component(self::ORIGIN, compact(self::PROPS));
        }
    }
}