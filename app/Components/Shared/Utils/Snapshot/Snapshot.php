<?php

namespace App\Components\Shared\Utils\Snapshot;

use App\Components\BaseComponents;
use stdClass;

class Snapshot extends BaseComponents
{
    const ORIGIN = "components/shared/utils/snapshot/index";
    const PROPS = [
        'ref',
        'api',
        'operation',
        'src',
        'size'
    ];

    /**
     * 
     * @param string $ref* O título de referência do snapshot
     * @param string $api  O path do endpoint que será enviado a imagem após troca ou processo. 
     * @param string $operation  O tipo de coluna que deseja alterar e guia da qual modulo executar no sistema PATCH
     * @param string $src  O url da imagem atual.
     * @param string $size O tamanho do componente com as variações "SM"(4.5rem), "MD"(6.5rem)
     */
    public static function render(
        string $ref = "",
        string $api = "",
        string $operation = "photo",
        string $src = "",
        string $size = "md"
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
