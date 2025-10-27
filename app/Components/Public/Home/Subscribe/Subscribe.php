<?php
namespace App\Components\Public\Home\Subscribe;

use App\Components\BaseComponents;

class Subscribe extends BaseComponents
{
    const ORIGIN = "components/public/home/subscribe";
    const PROPS = [];

    public static function render()
    {
        return Component(self::ORIGIN, compact(self::PROPS));
    }
}
