<?php

namespace App\Validations;

class ApiRules
{

    public function boolean(string|bool $value)
    {
        if (!is_bool($value))
            return false;

        return true;
    }
}
