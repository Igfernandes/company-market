<?php

namespace App\Helpers\Validates;

class Date
{
    public static function getValidDate(String $date)
    {
        $dateValid = null;

        if (empty($date)) return;
        $dateValid = explode("/", $date);

        if (count($dateValid) == 3) {
            $dateValid = join("-", array_reverse($dateValid));
        } elseif (count(explode("-", $date)) == 3) {
            $dateValid = $date;
        } else $dateValid = '';


        return $dateValid;
    }
}
