<?php

if (!function_exists('cleanString')) {
    function cleanString(string $str)
    {
        $str = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $str = preg_replace('/[^A-Za-z0-9 ]/', '', $str);
        $str = trim(preg_replace('/\s+/', ' ', $str));
        return  $str;
    }
}

if (!function_exists('formatPhoneToText')) {
    function formatPhoneToText(string $raw): string
    {
        // Remove tudo que não for número
        $digits = preg_replace('/\D+/', '', $raw);

        // Garante que tenha DDI +55 (se não tiver, adiciona)
        if (strlen($digits) === 11) {
            // Ex: 21999999999 → +55 (21) 99999-9999
            $digits = '55' . $digits;
        }

        if (strlen($digits) === 13) {
            $ddi = substr($digits, 0, 2);     // 55
            $ddd = substr($digits, 2, 2);     // 21
            $prefix = substr($digits, 4, 5);  // 99999
            $suffix = substr($digits, 9, 4);  // 9999

            return "+$ddi ($ddd) $prefix-$suffix";
        }

        // Caso não consiga formatar, retorna só os dígitos
        return $digits;
    }
}
