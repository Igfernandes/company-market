<?php

namespace App\Components\Shared\Layouts\Lists;

class Lists
{
    const ORIGIN = "components/shared/layouts/lists";
    const PROPS = [
        "type",
        "class",
        "rows",
        "action",
        "delete",
        "attributes",
    ];

    public static function render(
        ?string $type = "",
        ?string $class = "",
        ?array $rows = [],
        ?string $action = "",
        ?string $delete = "",
        ?array $attributes = [],
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
