<?php

namespace App\Components\Private\Companies\Trash;

use App\Components\BaseComponents;
use App\Components\Private\Layouts\Container\Container;

class Content extends BaseComponents
{
    const ORIGIN = "components/private/companies/trash/content";
    const PROPS = [];

    public static function render()
    {
        return Container::render(
            content: [
                Component(SELF::ORIGIN, compact(SELF::PROPS), true)
            ]
        );
    }
}