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
            echo "[PROBLEMS IN COMPONENT - $origin]: {$err->getMessage()} ";
        }
    }
}

if (!function_exists('getAttributes')) {
    function getAttributes(array $attributes)
    {
        if (!is_array($attributes))
            return "";

        $attributesRef = [];
        foreach ($attributes as $index => $attribute) {
            if (empty($attribute)) continue;
            array_push($attributesRef, join("=", [$index, $attribute]));
        }

        return join(" ", $attributesRef);
    }
}
