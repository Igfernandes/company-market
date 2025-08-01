<?php

namespace App\Components\Shared\Utils\Snackbar;

use App\Components\BaseComponents;

class Snackbar extends BaseComponents
{
    const ORIGIN = "components/shared/utils/snackbar";
    const PROPS = [
        'title',
        'message',
        'type',
        'action'
    ];

    /**
     * 
     * @param string $title* O título do snackbar, sendo ele fixo.
     * @param string $message* A mensagem que será exibida no snackbar.
     * @param SUCCESS|FAIL|NOTICE $type O tipo de status do snackbar atual.
     * @param string $action O conteúdo html em string referente a uma ação ou execução no snackbar. 
     */
    public static function render(
        string $title = "",
        string $message = "",
        string $type = "NOTICE",
        mixed $action = ""
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
