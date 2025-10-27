<?php

namespace App\Components\Private\Clients\Categories;

use App\Components\BaseComponents;
use App\Components\Private\Layouts\Container\Container;

class Content extends BaseComponents
{
    const ORIGIN = "components/private/clients/categories/content";
    const PROPS = [];

    public static function render()
    {
        return Container::render(
            head: [
                'title' => 'Gerenciar Categorias - Nautisys',
                'description' => 'Página reservada para gerenciar categorias de clientes'
            ],
            content: [
                Component(SELF::ORIGIN, compact(SELF::PROPS), true)
            ]
        );
    }
}
