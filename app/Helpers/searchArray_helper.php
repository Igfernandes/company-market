<?php

if (!function_exists('searchInArray')) {
    function searchInArray(array $arr, mixed $callback)
    {
        return array_values(array_filter($arr, $callback));
    }
}
