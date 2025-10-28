<?php

namespace App\Components\Shared\Forms\Fields\Select;

class SelectMapper
{

    public static function getOptionsByEntities(array $entities, string $textKey, string $valueKey): array
    {
        $options  = [];
        foreach ($entities as $entity) {
            $data  = $entity->toArray();

            array_push($options, [
                "text" => $data[$textKey],
                "value" => $data[$valueKey]
            ]);
        }

        return $options;
    }
}
