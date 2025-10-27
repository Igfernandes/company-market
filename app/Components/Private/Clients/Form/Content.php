<?php

namespace App\Components\Private\Clients\Form;

use App\Components\BaseComponents;
use App\Components\Private\Layouts\Container\Container;
use App\Database\Entities\Clients\ClientEntity;

class Content extends BaseComponents
{
    const ORIGIN = "components/private/clients/form/content";
    const PROPS = [
        'client',
        'categories'
    ];

    public static function render(
        ClientEntity $client = new ClientEntity(),
        array $categories = []
    ) {

        return Container::render(
            content: [
                Component(SELF::ORIGIN, compact(SELF::PROPS), true)
            ]
        );
    }
}
