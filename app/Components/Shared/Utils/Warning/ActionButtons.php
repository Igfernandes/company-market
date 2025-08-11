<?php

namespace App\Components\Shared\Utils\Warning;

use App\Components\BaseComponents;

class ActionButtons extends BaseComponents
{
    const ORIGIN = "components/shared/utils/warning/action-buttons";
    const PROPS = [
        'left',
        'right'
    ];

    /**
     * 
     * @param string $title* O título do modal, sendo ele fixo.
     * @param string $subtitle* O subtítulo do modal, sendo ele fixo.
     * @param string $message* A mensagem que será exibida no modal.
     * @param string $let Os atributos a serem atribuídos como guias de ações do lado esquerdo
     * @param string $right Os atributos a serem atribuídos como guias de ações do lado direito
     */
    public static function render(
        string $title = "",
        string $subtitle = "",
        string $message = "",
        array $left = [],
        array $right = [],
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
