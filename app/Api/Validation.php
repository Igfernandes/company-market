<?php

namespace App\Api;

trait Validation
{
    protected function getFiltered($rules)
    {

        $payload = [];
        foreach ($rules as $index => $data) {
            $payload[$index] = $this->request->getVar($index);
        }

        return $payload;
    }
}
