<?php

declare(strict_types=1);

namespace App\Components\Private\Clients\Categories\Modals;

use App\Components\BaseComponents;
use App\Components\Shared\Utils\Modal\Modal;

class ModalUpdate extends BaseComponents
{
    const ORIGIN = "components/private/clients/categories/modals/update";
    const PROPS = [];

    public static function render()
    {
        return Modal::render(
            type: "update",
            title: "Atualizar Categoria",
            content: Component(SELF::ORIGIN, compact(SELF::PROPS), true),
            left: "Cancelar",
            right: "Atualizar"
        );
    }
}
