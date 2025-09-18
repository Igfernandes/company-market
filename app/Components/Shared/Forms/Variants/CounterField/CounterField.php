<?php

namespace App\Components\Shared\Forms\Variants\CounterField;

use App\Components\BaseComponents;

class CounterField extends BaseComponents
{
    const ORIGIN = "components/shared/forms/variants/counterField";
    const PROPS = [
        "initial",
        "max",
        "target"
    ];

    public static function render(
        ?int $initial = 0,
        ?int $max = 0,
        ?string $target = ""
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
