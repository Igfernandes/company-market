<?php

namespace App\Api\Dispatchers\Put;

trait PutDTOs
{
    protected array $rules = [
        'id' => [
            'rules' => 'integer|required',
            'errors' => [
                'integer'  => 'Api.dispatchers.invalid.id',
                'required' => 'Api.dispatchers.invalid.id',
            ],
        ],
        'clients' => [
            'rules' => 'permit_empty',
            'errors' => [],
        ],
        'status' => [
            'rules' => 'string|required',
            'errors' => [
                'string'   => 'Api.dispatchers.invalid.status',
                'required' => 'Api.dispatchers.invalid.status',
            ],
        ],
    ];
}
