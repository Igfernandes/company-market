<?php

namespace App\Api\Operations\Clients\Categories\Put;

trait PutDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'numeric|required',
            'errors' => [
                'string' => 'Api.categories.invalid.id',
            ],
        ],
        'name' => [
            'rules'  => 'string|required|max_length[100]',
            'errors' => [
                'string' => 'Api.categories.invalid.name',
                'max_length' => 'Api.categories.invalid.name',
            ],
        ],
        'description' => [
            'rules'  => 'string|permit_empty|max_length[255]',
            'errors' => [
                'string'      => 'Api.categories.invalid.description',
                'max_length' => 'Api.categories.invalid.description',
            ],
        ]
    ];
}
