<?php

namespace App\Traits;

trait ControllersTrait
{

    public function convertPayloadToAssocArray($payload)
    {
        $payloadConverted = (array) $payload;
        $payloadAssoc = [];

        foreach ($payloadConverted as $index => $field) {
            $payloadAssoc[$index] = is_object($field) || is_array($field) ? $this->convertPayloadToAssocArray($field) : $field;
        };

        return  $payloadAssoc;
    }
}
