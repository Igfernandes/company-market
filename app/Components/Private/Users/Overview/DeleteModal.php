<?php

namespace App\Components\Private\Users\Overview;

use App\Components\BaseComponents;
use App\Components\Shared\Utils\Modal\Modal;

class DeleteModal extends BaseComponents
{
    const ORIGIN = "components/private/users/overview/deleteModal";
    const PROPS = [];

    public static function render()
    {
        return Modal::render(
            type: "user_delete",
            title: "Confirmar Exclusão",
            content: Component(SELF::ORIGIN, compact(SELF::PROPS), true),
            left: "Cancelar",
            right: "Excluir"
        );
    }
}
