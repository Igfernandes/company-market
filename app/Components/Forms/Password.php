<?php

namespace App\Components\Forms;

use App\Components\BaseComponent;

class Password extends BaseComponent
{
    public static function props(?string $name = "", int $label): array
    {
        return func_get_args();
    }
}
