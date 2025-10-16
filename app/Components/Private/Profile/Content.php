<?php

namespace App\Components\Private\Profile;

use App\Components\BaseComponents;
use App\Components\Private\Layouts\Container\Container;

class Content extends BaseComponents
{
    const ORIGIN = "components/private/profile/content";
    const PROPS = [];

    public static function render()
    {
        return Container::render(
            head: [
                'title' => 'Perfil do usuário - Nautisys',
                'description' => 'Página reservada para visualizar e atualizar informações do perfil'
            ],
            content: [
                Component(SELF::ORIGIN, compact(SELF::PROPS), true)
            ]
        );
    }
}
