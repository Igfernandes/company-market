<?php

namespace App\Components\Private\Settings;

use App\Components\BaseComponents;

class Board extends BaseComponents
{
    const ORIGIN = "components/private/settings/board";
    const PROPS = [
        'tabs',
        'boards'
    ];

    public static function render(
        array $tabs = ['Pessoal', 'Configurações'],
        array $boards = [
            [
                [
                    "icon" => '<i class="bi bi-person"></i>',
                    "text" => "Perfil",
                    "slug" => "profile"
                ],
                [
                    "icon" => '<i class="bi bi-card-list"></i>',
                    "text" => "Histórico",
                    "slug" => "history"
                ],
                [
                    "icon" => '<i class="bi bi-key"></i>',
                    "text" => "Alterar senha",
                    "slug" => "alter-password"
                ]
            ],
            [
                [
                    "icon" => '<i class="bi bi-list-check"></i>',
                    "text" => "Permissões",
                    "slug" => "permissions"
                ]
            ]
        ]
    ) {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
