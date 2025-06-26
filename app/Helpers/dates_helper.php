<?php

if (!function_exists('getYearsOldByDate')) {
    function getYearsOldByDate(string $birthdate)
    {
        // Converte string "dd/mm/yyyy" em objeto DateTime
        $birthdate = DateTime::createFromFormat('d/m/Y', $birthdate);
        $now = new DateTime();

        if (!$birthdate) {
            $birthdate = DateTime::createFromFormat('Y-m-d', $birthdate);
        }

        if (!$birthdate)
            return null;

        $yearsOld = $now->diff($birthdate)->y; // diferença em anos
        return $yearsOld;
    }
}
