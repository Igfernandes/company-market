<?php
namespace App\Components\Public\Header;

use App\Components\BaseComponents;

class Header extends BaseComponents
{
    const ORIGIN = "components/public/header/index";
    const PROPS = [];

    public static function render()
    {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
