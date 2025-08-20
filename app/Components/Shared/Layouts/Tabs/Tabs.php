<?php

namespace App\Components\Shared\Layouts\Tabs;

class Tabs
{
    const ORIGIN = "components/shared/layouts/tabs";
    const PROPS = [
        "id",
        "contents",
        "default"
    ];

    public static function render(
        ?string $id = "",
        array $contents = [],
        ?string $default = "",
        bool $isReturn = false
    ) {
        return Component(self::ORIGIN, compact(self::PROPS), $isReturn);
    }
}
