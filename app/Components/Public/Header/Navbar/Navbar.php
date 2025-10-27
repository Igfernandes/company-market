<?php

/**
 * Template de geração de componentes
 *
 * ⚠️ Este arquivo contém placeholders (ex: Navbar, App\Components\Public\Header\Navbar) que
 * são substituídos dinamicamente pelo comando `php spark component:make`.
 *
 */

namespace App\Components\Public\Header\Navbar;

use App\Components\BaseComponents;

class Navbar extends BaseComponents
{
    const ORIGIN = "components/public/header/navbar";
    const PROPS = [
        "menu"
    ];

    public static function render(
        array $menu = [
            [
                "text" => "Início",
                "link" => "#home"
            ],
            [
                "text" => "Sobre Nós",
                "link" => "#about-us"
            ],
            [
                "text" => "Serviços",
                "link" => "#services"
            ],
            [
                "text" => "Clientes",
                "link" => "#clients"
            ],
        ]
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
