<?php

namespace App\Api\Services\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.services.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.services.invalid.in_ids',
            ],
        ],
        'name' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.services.invalid.name',
            ],
        ],
        'name_contains' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.services.invalid.name_contains',
            ],
        ],
        'type' => [
            'rules'  => 'string|in_list[APPELLANT,PUNCTUAL]|permit_empty',
            'errors' => [
                'string'  => 'Api.services.invalid.type',
                'in_list' => 'Api.services.invalid.type',
            ],
        ],
        'description_contains' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.services.invalid.description_contains',
            ],
        ],
        'status' => [
            'rules'  => 'in_list[ACTIVE,INACTIVE]|permit_empty',
            'errors' => [
                'in_list' => 'Api.services.invalid.status',
            ],
        ],
        'privacy' => [
            'rules'  => 'in_list[PUBLIC,PRIVATE]|permit_empty',
            'errors' => [
                'in_list' => 'Api.services.invalid.privacy',
            ],
        ],
        'created_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.services.invalid.created_at',
            ],
        ],
        'updated_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.services.invalid.updated_at',
            ],
        ],
    ];
}
