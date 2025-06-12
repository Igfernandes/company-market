<?php

namespace App\Api\Authentications\RememberMe;

trait PostDTOs
{
    protected array $rules = [
        'reference-token' => [
            'rules'  => 'string|required',
            'errors' => [
                'string' => 'Api.remember.invalid.token',
                'required' => 'Api.remember.invalid.token',
            ],
        ],
    ];
}
