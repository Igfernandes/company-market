<?php

namespace App\Components\Shared\Layouts\Topics\Topic;

use App\Components\BaseComponents;

class Topic extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/topics/topic";
    const PROPS = [
        'ref',
        'title',
        'text',
        'image',
        'price',
        'link'
    ];

    public static function render(
        string $ref = "",
        string $title = "",
        string $text = "",
        string $image = "",
        float $price = 0,
        ?string $link = ""
    ) {
        return Component(self::ORIGIN, compact(self::PROPS), true);
    }
}
