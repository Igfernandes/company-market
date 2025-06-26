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
