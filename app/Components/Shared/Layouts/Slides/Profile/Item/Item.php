<?php

namespace App\Components\Shared\Layouts\Slides\Profile\Item;

use App\Components\BaseComponents;

class Item extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/slides/profile/item";
    const PROPS = [
        'logotype',
        'name',
        'social_media',
        'created_at'
    ];

    public static function render(
        ?string $logotype = "",
        ?string $name = "",
        ?array $social_media = [],
        ?string $created_at = ""
    ) {
        return Component(self::ORIGIN, compact(self::PROPS), true);
    }
}
