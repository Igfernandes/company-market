<?php

declare(strict_types=1);

namespace App\Components\Private\Users\Trash\Modals;

use App\Components\BaseComponents;
use App\Components\Shared\Utils\Modal\Modal;

class ModalRecover extends BaseComponents
{
    const ORIGIN = "components/private/users/trash/modals/recover";
    const PROPS = [];

    public static function render()
    {
        return Modal::render(
            type: "recover",
            title: "Recuperar Usuário",
            content: Component(SELF::ORIGIN, compact(SELF::PROPS), true),
            left: "Cancelar",
            right: "Restaurar"
        );
    }
}
