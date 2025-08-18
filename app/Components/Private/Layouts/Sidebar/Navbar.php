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
            'overview' => 'Visão Geral',
            'news' => 'Notícias',
            'statistics' => 'Estatísticas',
        ],
        'GESTÃO' => [
            'clients' => 'Clientes',
            'boat' => 'Embarcações',
            'documents' => 'Documentos',
            'forms' => 'Formulários',
        ],
        'FINANCEIRO' => [
            'sales' => 'Vendas',
            'charges' => 'Cobranças',
            'expenses' => 'Despesas',
            'coupons' => 'Cupons'
        ],
        'SISTEMA' => [
            '/logout' => 'Sair'
        ]
    ];

    public static function render(
        array $menu = self::MENU
    ) {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
