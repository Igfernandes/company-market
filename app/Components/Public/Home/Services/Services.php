<?php
namespace App\Components\Public\Home\Services;

use App\Components\BaseComponents;

class Services extends BaseComponents
{
    const ORIGIN = "components/public/home/services";
    const PROPS = [];

    public static function render()
    {
        return Component(self::ORIGIN, compact(self::PROPS));
    }
}
