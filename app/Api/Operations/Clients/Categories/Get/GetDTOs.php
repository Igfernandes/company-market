<?php

namespace App\Api\Operations\Clients\Categories\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.clients.categories.invalid.id',
            ],
        ],
        'in_ids' => [
            'rules'  => 'permit_empty'
        ],
        'client_id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.clients.categories.invalid.client_id',
            ],
        ],
        'name' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.clients.categories.invalid.name',
            ],
        ],
        'name_contains' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.clients.categories.invalid.name_contains',
            ],
        ],
        'description_contains' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.clients.categories.invalid.description_contains',
            ],
        ],
        'created_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.clients.categories.valid_date.created_at',
            ],
        ],
        'updated_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.clients.categories.valid_date.updated_at',
            ],
        ]
    ];
}
