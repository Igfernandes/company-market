<?php

namespace App\Components\Private\Sidebar;

use App\Components\BaseComponents;
use App\Database\Entities\Users\UserEntity;

class Sidebar extends BaseComponents
{
    const ORIGIN = "components/private/sidebar/index";
    const PROPS = [
        'user'
    ];

    public static function render(
        ?UserEntity $user = null
    ) {
        Component(SELF::ORIGIN, compact(SELF::PROPS));
    }
}
