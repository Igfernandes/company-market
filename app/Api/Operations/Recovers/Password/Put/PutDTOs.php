<?php

namespace App\Api\Operations\Recovers\Password\Put;

trait PutDTOs
{
    protected array $rules = [
        'token' => [
            'rules'  => 'string|required|max_length[50]',
            'errors' => [
                'string'     => 'Api.recovers.password.invalid.token',
                'required'   => 'Api.recovers.password.invalid.token',
                'max_length' => 'Api.recovers.password.invalid.token',
            ],
        ],
        'password' => [
            'rules'  => 'string|required|regex_match[' . VALIDATE_PASSWORD . ']',
            'errors' => [
                'string'      => 'Api.recovers.password.invalid.password',
                'required'    => 'Api.recovers.password.invalid.password',
                'regex_match' => 'Api.recovers.password.invalid.password',
            ],
        ],
    ];
}
