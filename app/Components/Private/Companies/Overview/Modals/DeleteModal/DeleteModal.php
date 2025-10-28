<?php

namespace App\Components\Private\Companies\Overview\Modals\DeleteModal;

use App\Components\BaseComponents;
use App\Components\Shared\Utils\Modal\Modal;

class DeleteModal extends BaseComponents
{
    const ORIGIN = "components/private/companies/overview/modals/deleteModal";
    const PROPS = [];

    public static function render()
    {
        return Modal::render(
            type: "company_delete",
            title: "Confirmar Exclusão",
            content: Component(SELF::ORIGIN, compact(SELF::PROPS), true),
            left: "Cancelar",
            right: "Excluir"
        );
    }
}
