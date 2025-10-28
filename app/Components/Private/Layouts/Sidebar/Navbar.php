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
        'GESTÃO' => [
            [
                'title' => 'Clientes',
                'slug' => 'clients'
            ],
            [
                'title' => 'Empresas',
                'slug' => 'companies'
            ]
        ],
        'COMUNICAÇÃO' => [
            [
                'title' => 'Envios',
                'slug' => 'dispatchers'
            ],
            [
                'title' => 'Conteúdo',
                'slug' => 'content'
            ]
        ],
        'SISTEMA' => [
            [
                'title' => 'Usuários',
                'slug' => 'users'
            ],
            [
                'title' => 'Sair',
                'slug' => 'logout'
            ]
        ]
    ];

    public static function render(
        array $menu = self::MENU
    ) {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
