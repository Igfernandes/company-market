<?php

namespace App\Api;

use App\Libraries\Exceptions\Exceptions;

trait Validation
{
    protected function getPayload(?array $data = [])
    {
        $validation = \Config\Services::validation();
        $payload = $this->request->getVar(array_keys($this->rules));

        if (\is_array($data))
            $payload = array_merge($payload, $data);

        $validation->setRules($this->rules);

        if (!$validation->run($payload))
            throw new Exceptions($validation->getErrors(), BAD_REQUEST);

        return $payload;
    }
}
