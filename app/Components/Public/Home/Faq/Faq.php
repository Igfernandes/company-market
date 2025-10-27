<?php
namespace App\Components\Public\Home\Faq;

use App\Components\BaseComponents;

class Faq extends BaseComponents
{
    const ORIGIN = "components/public/home/faq";
    const PROPS = [];

    public static function render()
    {
        return Component(self::ORIGIN, compact(self::PROPS));
    }
}
