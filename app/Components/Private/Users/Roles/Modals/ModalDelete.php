<?php

declare(strict_types=1);

namespace App\Components\Private\Users\Roles\Modals;

use App\Components\BaseComponents;
use App\Components\Shared\Utils\Modal\Modal;

class ModalDelete extends BaseComponents
{
    const ORIGIN = "components/private/users/roles/modals/delete";
    const PROPS = [];

    public static function render()
    {
        return Modal::render(
            type: "delete",
            title: "Excluir Função",
            content: Component(SELF::ORIGIN, compact(SELF::PROPS), true),
            left: "Cancelar",
            right: "Excluir"
        );
    }
}
