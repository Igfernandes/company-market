<?php
namespace App\Components\Public\Home\Contact;

use App\Components\BaseComponents;

class Contact extends BaseComponents
{
    const ORIGIN = "components/public/home/contact";
    const PROPS = [];

    public static function render()
    {
        return Component(self::ORIGIN, compact(self::PROPS));
    }
}
