<?php

namespace App\Components\Private\Profile;

use App\Components\BaseComponents;

class Permissions extends BaseComponents
{
    const ORIGIN = "components/private/profile/permissions";
    const PROPS = [
        'userId'
    ];

    public static function render(
        int $userId = 0
    ) {
        return Component(SELF::ORIGIN, compact(SELF::PROPS), true);
    }
}
