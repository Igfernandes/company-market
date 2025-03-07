<?php

namespace App\Api\Authentications\RememberMe;

trait PostDTOs
{
    protected array $rules = [
        'reference-token' => [
            'label'  => 'reference-token',
            'rules'  => 'string|required',
            'errors' => [
                'string' => 'Validation.string',
            ],
        ],
    ];
}
