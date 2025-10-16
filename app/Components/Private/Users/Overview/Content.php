<?php

namespace App\Components\Private\Users\Overview;

use App\Components\BaseComponents;
use App\Components\Private\Layouts\Container\Container;

class Content extends BaseComponents
{
    const ORIGIN = "components/private/users/overview/content";
    const PROPS = [];

    public static function render()
    {
        return Container::render(
            head: [
                'title' => 'Listagem de usuários - Nautisys',
                'description' => 'Página reservada para visualizar a listagem de usuário'
            ],
            content: [
                Component(SELF::ORIGIN, compact(SELF::PROPS), true)
            ]
        );;
    }
}
