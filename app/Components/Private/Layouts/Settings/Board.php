<?php

namespace App\Components\Private\Layouts\Settings;

use App\Components\BaseComponents;

class Board extends BaseComponents
{
    const ORIGIN = "components/private/layouts/settings/board";
    const PROPS = [
        'tabs',
        'boards'
    ];

    public static function render(
        array $tabs = ['Pessoal'],
        array $boards = [
            [
                [
                    "icon" => '<i class="bi bi-person"></i>',
                    "text" => "Perfil",
                    "slug" => "profile"
                ],
                [
                    "icon" => '<i class="bi bi-key"></i>',
                    "text" => "Alterar senha",
                    "slug" => "alter-password"
                ]
            ],
        ]
    ) {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
