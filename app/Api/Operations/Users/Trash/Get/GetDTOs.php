<?php

namespace App\Api\Operations\Users\Trash\Get;

trait GetDTOs
{
    protected array $rules = [
        'current' => [
            'rules'  => 'in_list[0,1]|permit_empty',
            'errors' => [
                'in_list' => 'Api.users.invalid.current',
            ],
        ],
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.users.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.users.invalid.in_ids',
            ],
        ],
        'name' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.users.invalid.name',
            ],
        ],
        'document' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string'      => 'Api.users.invalid.document',
                'regex_match' => 'Api.users.invalid.document',
            ],
        ],
        'phone' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.users.invalid.phone',
            ],
        ],
        'birthdate' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.users.invalid.birthdate',
            ],
        ],
        'status' => [
            'rules'  => 'in_list[ACTIVE, INACTIVE]|permit_empty',
            'errors' => [
                'in_list' => 'Api.users.invalid.status',
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
