<?php
namespace App\Components\Private\Clients\Form\Information\Describe;

use App\Components\BaseComponents;

class Describe extends BaseComponents
{
    const ORIGIN = "components/private/clients/form/information/describe";
    const PROPS = [];

    public static function render()
    {
        return Component(self::ORIGIN, compact(self::PROPS));
    }
}
