<?php

namespace App\Components\Private\Layouts\Sidebar;

use App\Components\BaseComponents;

class Navbar extends BaseComponents
{
    const ORIGIN = "components/private/layouts/sidebar/navbar";
    const PROPS = [
        'menu'
    ];
    const MENU = [
        'PRINCIPAL' => [
            'clients' => 'Clientes',
            'dispatchers' => 'Envios',
            'content' => 'Conteúdo'
        ],
        'SISTEMA' => [
            'users' => 'usuários',
            '/logout' => 'Sair'
        ]
    ];

    public static function render(
        array $menu = self::MENU
    ) {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
