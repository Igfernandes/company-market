<?php

namespace App\Components\Shared\Utils\Modal;

use App\Components\BaseComponents;

class Modal extends BaseComponents
{
    const ORIGIN = "components/shared/utils/modal";
    const PROPS = [
        'title',
        'subtitle',
        'message',
        'action'
    ];

    /**
     * 
     * @param string $title* O título do modal, sendo ele fixo.
     * @param string $subtitle* O subtítulo do modal, sendo ele fixo.
     * @param string $message* A mensagem que será exibida no modal.
     * @param string $action O conteúdo html em string referente a uma ação ou execução no modal. 
     */
    public static function render(
        string $title = "",
        string $subtitle = "",
        string $message = "",
        mixed $action = ""
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}