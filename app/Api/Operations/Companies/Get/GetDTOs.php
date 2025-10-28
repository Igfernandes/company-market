<?php

namespace App\Api\Operations\Companies\Get;

trait GetDTOs
{
    protected array $rules = [
        'in_ids.*' => [
            'rules' => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.companies.invalid.in_ids',
            ],
        ],
        'name' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.companies.invalid.name',
            ],
        ],
        'phone' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.companies.invalid.phone',
            ],
        ],
        'inscribed_at' => [
            'rules' => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.companies.invalid.inscribed_at',
            ],
        ],
        'status' => [
            'rules' => 'in_list[ACTIVE, INACTIVE]|permit_empty',
            'errors' => [
                'in_list' => 'Api.companies.invalid.status',
            ],
        ],
        'created_at' => [
            'rules' => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.companies.invalid.created_at',
            ],
        ],
        'updated_at' => [
            'rules' => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.companies.invalid.updated_at',
            ],
        ],
        'start' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.users.invalid.start',
            ],
        ],
        'limit' => [
            'rules'  => 'numeric|less_than_equal_to[500]|permit_empty',
            'errors' => [
                'numeric'    => 'Api.users.invalid.limit',
                'less_than_equal_to' => 'Api.users.invalid.limit',
            ],
        ],
    ];
}
