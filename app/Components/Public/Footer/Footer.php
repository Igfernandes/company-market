<?php

namespace App\Components\Public\Footer;

use App\Components\BaseComponents;

class Footer extends BaseComponents
{
    public static function render()
    {
        Component("components/public/footer", compact([]));
    }
}
