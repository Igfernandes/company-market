<?php

namespace App\Components\Private\Sidebar;

use App\Components\BaseComponents;

class SubMenu extends BaseComponents
{
    const ORIGIN = "components/private/sidebar/submenu";
    const PROPS = [
        'topic',
        'submenu'
    ];
    const SUBMENU = [
        'clients' => [
            'none' => 'Geral',
            'create' => 'Criar',
        ],
        'boat' => [
            'none' => 'Geral',
            'create' => 'Criar',
            'teste' => 'test'
        ],
        'documents' => [
            'none' => 'Geral',
            'create' => 'Criar',
        ],
        'forms' => [
            'none' => 'Geral',
            'create' => 'Criar',
        ],
    ];

    public static function render(
        string $topic = "",
        array $submenu = self::SUBMENU
    ) {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
