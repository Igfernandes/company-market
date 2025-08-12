<?php

namespace App\Components\Shared\Utils\Modal;

use App\Components\BaseComponents;

class Modal extends BaseComponents
{
    const ORIGIN = "components/shared/utils/modal";
    const PROPS = [
        'type',
        'title',
        'subtitle',
        'content',
        'left',
        'right'
    ];

    /**
     * @param string $type O tipo do modal.
     * @param string $title O título do modal, sendo ele fixo.
     * @param string $subtitle O subtítulo do modal, sendo ele fixo.
     * @param string $content O conteúdo que será exibido no modal
     * @param string $left O botão da esquerda. 
     * @param string $right O botão da direita. 
     */
    public static function render(
        string $type = "",
        ?string $title = "",
        ?string $subtitle = "",
        ?string $content = "",
        ?string $left = "",
        ?string $right = "",
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}