<?php


if (!function_exists('removeDuplicatesInArrayEntitiesById')) {
    function removeDuplicatesInArrayEntitiesById(array $entities, string $property): array
    {
        $unique = [];
        $filtered = [];

        foreach ($entities as $entity) {
            if (!in_array($entity->getId(), $unique, true)) {
                $unique[] = $entity->getId();
                $filtered[] = $entity;
            }
        }

        return $filtered;
    }
}
