<?php

if (!function_exists('getNotEmptyValue')) {
    function getNotEmptyValue(array $arr)
    {
        return array_values(array_filter($arr, function ($value) {
            return !empty($value);
        }));
    }
}


