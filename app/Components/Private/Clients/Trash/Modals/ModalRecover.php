<?php

declare(strict_types=1);

namespace App\Components\Private\Clients\Trash\Modals;

use App\Components\BaseComponents;
use App\Components\Shared\Utils\Modal\Modal;

class ModalRecover extends BaseComponents
{
    const ORIGIN = "components/private/clients/trash/modals/recover";
    const PROPS = [];

    public static function render()
    {
        return Modal::render(
            type: "recover",
            class: "w-90 md:w-40",
            title: "Recuperar Cliente",
            content: Component(SELF::ORIGIN, compact(SELF::PROPS), true),
            left: "Cancelar",
            right: "Restaurar"
        );
    }
}
