<?php
namespace App\Components\Private\Companies\Form\Information\Describe;

use App\Components\BaseComponents;

class Describe extends BaseComponents
{
    const ORIGIN = "components/private/companies/form/information/describe";
    const PROPS = [];

    public static function render()
    {
        return Component(self::ORIGIN, compact(self::PROPS));
    }
}
