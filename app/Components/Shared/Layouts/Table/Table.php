<?php

namespace App\Components\Shared\Layouts\Table;

class Table
{
    const ORIGIN = "components/shared/layouts/table";
    const PROPS = [
        "id",
        "class",
        "dataTitles",
        "dataTable"
    ];

    public static function render(
        ?string $id = "",
        ?string $class = "",
        ?array $dataTitles = [],
        ?array $dataTable = [[]]
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
