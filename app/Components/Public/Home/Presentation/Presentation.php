<?php
/**
 * Template de geração de componentes
 *
 * ⚠️ Este arquivo contém placeholders (ex: Presentation, App\Components\Public\Home\Presentation) que
 * são substituídos dinamicamente pelo comando `php spark component:make`.
 *
 */

namespace App\Components\Public\Home\Presentation;

use App\Components\BaseComponents;

class Presentation extends BaseComponents
{
    const ORIGIN = "components/public/home/presentation";
    const PROPS = [];

    public static function render()
    {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
