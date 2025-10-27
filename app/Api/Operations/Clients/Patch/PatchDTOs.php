<?php

namespace App\Api\Operations\Clients\Patch;

trait PatchDTOs
{
    protected array $rules = [
        'operation' => [
            'rules' => 'string',
            'errors' => [
                'string' => 'Api.clients.invalid.operation',
            ],
        ],
        'data' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Api.clients.invalid.data',
            ],
        ],
    ];
}
