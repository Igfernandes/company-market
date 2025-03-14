<?php

if (!function_exists('removeDuplicatesInArray')) {
    function removeDuplicatesInArray(array $objects, string $property): array
    {
        $unique = [];
        $filtered = [];

        foreach ($objects as $object) {
            if (!isset($object->$property)) {
                continue; // Pula objetos que não têm a propriedade especificada
            }

            $value = $object->$property;

            if (!in_array($value, $unique, true)) {
                $unique[] = $value;
                $filtered[] = $object;
            }
        }

        return $filtered;
    }
}
