<?php

namespace App\Components\Private\Clients\Form\Information\Sidebar;

use App\Components\BaseComponents;

class Sidebar extends BaseComponents
{
    const ORIGIN = "components/private/clients/form/information/sidebar";
    const PROPS = [
        'id'
    ];

    public static function render(
        ?int $id = null
    ) {
        return Component(self::ORIGIN, compact(self::PROPS));
    }
}
