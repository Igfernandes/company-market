<?php

namespace App\Helpers\Validates;

class Values
{

    public function hasSomeValue($value): Bool
    {
        return  isset($value) || !empty($value);
    }

    public function hasValueOfList($value, array $arrValues): Bool
    {
        return array_search($value, $arrValues) !== false;
    }
}
