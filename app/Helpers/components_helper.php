<?php

if (!function_exists('Component')) {
    function Component(string $origin, ?array $props = [], bool $return = false)
    {
        try {
            $component = view($origin, $props);

            if ($return)
                return $component;

            echo $component;
        } catch (Exception $err) {
            echo "[COMPONENT NOT FOUND]: $origin";
        }
    }
}
