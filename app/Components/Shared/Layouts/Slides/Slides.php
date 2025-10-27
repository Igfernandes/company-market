<?php

/**
 * Template de geração de componentes
 *
 * ⚠️ Este arquivo contém placeholders (ex: Slides, App\Components\Shared\Layouts\Slides) que
 * são substituídos dinamicamente pelo comando `php spark component:make`.
 *
 */

namespace App\Components\Shared\Layouts\Slides;

use App\Components\BaseComponents;


class Slides extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/slides/index";
    const PROPS = [
        'id',
        'slides',
        'configs'
    ];

    /**
     * Renderiza o componente de slides com base nos parâmetros fornecidos.
     *
     * @param array $slides: array|string[] URLs ou blocos HTML de slides
     * @param string $class: string classes adicionais
     * @param array $config: array com as opções do Swiper (loop, autoplay, etc.)
     */
    public static function render(
        string $id = "",
        ?array $slides = [],
        ?string $class = "",
        ?array $configs = []
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
