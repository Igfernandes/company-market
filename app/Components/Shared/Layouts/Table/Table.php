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
        "relations",
        "ajax",
        "update",
        "delete",
        "checked",
        "attributes",
    ];

    /**
     * @param ?string $update A url para a página de atualização
     * @param ?string $delete O parâmetro/entidade de referência que o sistema vai usar para ações de exclusões.
     */
    public static function render(
        ?string $id = "",
        ?string $class = "",
        ?array $heads = [],
        ?array $data = [[]],
        ?string $ajax = "",
        ?string $update = "",
        ?string $delete = "",
        ?bool $checked = false,
        ?array $relations = [],
        ?array $attributes = [],
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
