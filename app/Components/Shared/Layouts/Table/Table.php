<?php

namespace App\Components\Shared\Layouts\Table;

class Table
{
    const ORIGIN = "components/shared/layouts/table";
    const PROPS = [
        "id",
        "class",
        "heads",
        "data",
        "ajax",
        "attributes",
    ];

    public static function render(
        ?string $id = "",
        ?string $class = "",
        ?array $heads = [],
        ?array $data = [[]],
        ?string $ajax = "",
        ?array $attributes = [],
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
