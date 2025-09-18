<?php

namespace App\Api\Operations\Users\Roles\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.roles.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.roles.invalid.in_ids',
            ],
        ],
        'name' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.roles.invalid.name',
            ],
        ],
        'name_contains' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.roles.invalid.name',
            ],
        ],
        'description_contains' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string'      => 'Api.roles.invalid.description',
                'regex_match' => 'Api.invalid.description',
            ],
        ],
        'status' => [
            'rules'  => 'in_list[ACTIVE, INACTIVE]|permit_empty',
            'errors' => [
                'in_list' => 'Api.roles.invalid.status',
            ],
        ],
        'start' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.roles.invalid.start',
            ],
        ],
        'limit' => [
            'rules'  => 'numeric|less_than_equal_to[500]|permit_empty',
            'errors' => [
                'numeric'    => 'Api.roles.invalid.limit',
                'less_than_equal_to' => 'Api.roles.invalid.limit',
            ],
        ],
    ];
}
