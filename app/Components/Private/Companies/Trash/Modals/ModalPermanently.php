<?php

declare(strict_types=1);

namespace App\Components\Private\Companies\Trash\Modals;

use App\Components\BaseComponents;
use App\Components\Shared\Utils\Modal\Modal;

class ModalPermanently extends BaseComponents
{
    const ORIGIN = "components/private/companies/trash/modals/permanently";
    const PROPS = [];

    public static function render()
    {
        return Modal::render(
            type: "delete",
            class: "w-90 md:w-40",
            title: "Excluir Permanentemente",
            content: Component(SELF::ORIGIN, compact(SELF::PROPS), true),
            left: "Cancelar",
            right: "Excluir"
        );
    }
}
