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
        ],
        'boat' => [
            'boat' => 'Geral',
            'boat/create' => 'Criar'
        ],
        'documents' => [
            'documents' => 'Geral',
            'documents/create' => 'Criar',
        ],
        'forms' => [
            'forms' => 'Geral',
            'forms/create' => 'Criar',
        ],
        'users' => [
            'users' => 'Geral'
        ]
    ];

    public static function render(
        string $topic = "",
        array $submenu = self::SUBMENU
    ) {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
