<?php
namespace App\Components\Public\Home\Clients;

use App\Components\BaseComponents;

class Clients extends BaseComponents
{
    const ORIGIN = "components/public/home/clients";
    const PROPS = [];

    public static function render()
    {
        return Component(self::ORIGIN, compact(self::PROPS));
    }
}
