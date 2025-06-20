<?php

namespace App\Api\Clients\Services\Patch;

trait PatchDTOs
{
    protected array $rules = [
        'path' => [
            'rules' => 'string',
            'errors' => [
                'string' => 'Api.clients.invalid.path',
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
