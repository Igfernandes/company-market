<?php

if (!function_exists('getYearsOldByBrazilianDate')) {
    function getYearsOldByBrazilianDate(string $birthdate)
    {
        // Converte string "dd/mm/yyyy" em objeto DateTime
        $birthdate = DateTime::createFromFormat('d/m/Y', $birthdate);
        $now = new DateTime();

        if (!$birthdate) {
            return null; // Retorna nulo se a data for inválida
        }

        $yearsOld = $now->diff($birthdate)->y; // diferença em anos
        return $yearsOld;
    }
}
