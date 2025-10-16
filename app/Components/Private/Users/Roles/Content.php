<?php

namespace App\Components\Private\Users\Roles;

use App\Components\BaseComponents;
use App\Components\Private\Layouts\Container\Container;

class Content extends BaseComponents
{
    const ORIGIN = "components/private/users/roles/content";
    const PROPS = [];

    public static function render()
    {
        return Container::render(
            head: [
                'title' => 'Gerenciar Funções - Nautisys',
                'description' => 'Página reservada para gerenciar funções dos usuários'
            ],
            content: [
                Component(SELF::ORIGIN, compact(SELF::PROPS), true)
            ]
        );
    }
}
