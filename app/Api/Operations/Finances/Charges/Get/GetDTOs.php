<?php

namespace App\Api\Operations\Finances\Charges\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.charges.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.charges.invalid.in_ids',
            ],
        ],
        'title' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.charges.invalid.title',
            ],
        ],
        'description' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.charges.invalid.description',
            ],
        ],
        'status' => [
            'rules'  => 'string|in_list[ACTIVE, INACTIVE]|permit_empty',
            'errors' => [
                'string'  => 'Api.charges.invalid.status',
                'in_list' => 'Api.charges.invalid.status',
            ],
        ],
        'service_id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.charges.invalid.service_id',
            ],
        ],
        'type' => [
            'rules'  => 'string|in_list[APPELLANT, PUNCTUAL]|permit_empty',
            'errors' => [
                'string'  => 'Api.charges.invalid.type',
                'in_list' => 'Api.charges.invalid.type',
            ],
        ],
        'price' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.charges.invalid.price',
            ],
        ],
        'promotional_price' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.charges.invalid.promotional_price',
            ],
        ],
        'created_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.charges.invalid.created_at',
            ],
        ],
        'updated_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.charges.invalid.updated_at',
            ],
        ],
    ];
}
