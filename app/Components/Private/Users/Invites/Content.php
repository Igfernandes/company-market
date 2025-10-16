<?php

namespace App\Components\Private\Users\Invites;

use App\Components\BaseComponents;
use App\Components\Private\Layouts\Container\Container;

class Content extends BaseComponents
{
    const ORIGIN = "components/private/users/invites/content";
    const PROPS = [];

    public static function render()
    {
        return Container::render(
            head: [
                'title' => 'Área de Convites - Nautisys',
                'description' => 'Página reservada para gerenciar convites de usuário'
            ],
            content: [
                Component(SELF::ORIGIN, compact(SELF::PROPS), true)
            ]
        );
    }
}
