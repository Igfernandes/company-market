<?php
/**
 * Template de geração de componentes
 *
 * ⚠️ Este arquivo contém placeholders (ex: Header, App\Components\Public\Home\Header) que
 * são substituídos dinamicamente pelo comando `php spark component:make`.
 *
 */

namespace App\Components\Public\Home\Header;

use App\Components\BaseComponents;

class Header extends BaseComponents
{
    const ORIGIN = "components/public/home/header";
    const PROPS = [];

    public static function render()
    {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
