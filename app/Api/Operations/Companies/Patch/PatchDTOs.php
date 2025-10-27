<?php

namespace App\Api\Operations\Companies\Patch;

trait PatchDTOs
{
    protected array $rules = [
        'operation' => [
            'rules' => 'string',
            'errors' => [
                'string' => 'Api.companies.invalid.operation',
            ],
        ],
        'data' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Api.companies.invalid.data',
            ],
        ],
    ];
}
