<?php

namespace App\Api\Operations\Companies\Trash\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.companies.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.companies.invalid.in_ids',
            ],
        ],
        'name' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.companies.invalid.name',
            ],
        ],
        'phone' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.companies.invalid.phone',
            ],
        ],

        'status' => [
            'rules'  => 'permit_empty|in_list[AVAILABLE,MAINTENANCE,UNAVAILABLE]',
            'errors' => [
                'in_list' => 'Api.companies.invalid.status',
            ],
        ],
        'start' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.companies.invalid.start',
            ],
        ],
        'limit' => [
            'rules'  => 'numeric|less_than_equal_to[500]|permit_empty',
            'errors' => [
                'numeric'    => 'Api.companies.invalid.limit',
                'less_than_equal_to' => 'Api.companies.invalid.limit',
            ],
        ],
    ];
}
