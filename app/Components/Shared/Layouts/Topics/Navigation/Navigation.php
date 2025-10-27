<?php
namespace App\Components\Shared\Layouts\Topics\Navigation;

use App\Components\BaseComponents;

class Navigation extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/topics/navigation";
    const PROPS = [
        'menu'
    ];

    public static function render(
        ?array $menu = []
    )
    {
        return Component(self::ORIGIN, compact(self::PROPS));
    }
}
