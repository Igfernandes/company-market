<?php
/**
 * Template de geração de componentes
 *
 * ⚠️ Este arquivo contém placeholders (ex: Content, App\Components\Public\Home\Content) que
 * são substituídos dinamicamente pelo comando `php spark component:make`.
 *
 */

namespace App\Components\Public\Home\Content;

use App\Components\BaseComponents;

class Content extends BaseComponents
{
    const ORIGIN = "components/public/home/content";
    const PROPS = [];

    public static function render()
    {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
