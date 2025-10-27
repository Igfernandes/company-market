<?php

declare(strict_types=1);

namespace App\Components\Private\Clients\Categories\Modals;

use App\Components\BaseComponents;
use App\Components\Shared\Utils\Modal\Modal;

class ModalDelete extends BaseComponents
{
    const ORIGIN = "components/private/clients/categories/modals/delete";
    const PROPS = [];

    public static function render()
    {
        return Modal::render(
            type: "delete",
            title: "Excluir Categoria",
            class: "w-100 md:w-30",
            content: Component(SELF::ORIGIN, compact(SELF::PROPS), true),
            left: "Cancelar",
            right: "Excluir"
        );
    }
}
