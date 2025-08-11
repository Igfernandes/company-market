<?php

namespace App\Api\Operations\Users\Patch;

trait PatchDTOs
{
    protected array $rules = [
        'operation' => [
            'rules'  => 'string|required',
            'errors' => [
                'string'   => 'Api.users.invalid.operation',
                'required' => 'Api.users.invalid.operation',
            ],
        ],
    ];
}
