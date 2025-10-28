<?php

namespace App\Components\Private\Layouts\Sidebar;

use App\Components\BaseComponents;

class SubMenu extends BaseComponents
{
    const ORIGIN = "components/private/layouts/sidebar/submenu";
    const PROPS = [
        'topic',
        'submenu'
    ];
    const SUBMENU = [
        'clients' => [
            'clients' => 'Geral',
            'clients/create' => 'Criar',
            'clients/categories' => 'Categorias'
        ],
        'companies' => [
            'companies' => 'Geral',
            'companies/create' => 'Criar'
        ],
        'content' => [
            'contents' => 'Geral',
            'contents/create' => 'Criar'
        ],
        'users' => [
            'users' => 'Geral',
            'users/invites' => 'Convites',
            'users/trash' => 'Lixeira',
            'users/roles' => 'Funções',
        ]
    ];

    public static function render(
        string $topic = "",
        array $submenu = self::SUBMENU
    ) {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
