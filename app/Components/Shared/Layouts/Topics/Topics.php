<?php

namespace App\Components\Shared\Layouts\Topics;

use App\Components\BaseComponents;

class Topics extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/topics/index";
    const PROPS = [
        "id",
        "topics",
        "default",
        "title"
    ];

    public static function render(
        string $id = "",
        ?string $title = "",
        ?string $default = "",
        ?array $topics = []
    ) {
        return Component(self::ORIGIN, compact(self::PROPS));
    }
}
