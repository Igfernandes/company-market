<?php

namespace App\Api\Operations\Users\Groups\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.users.groups.invalid.id',
            ],
        ],
        'in_ids' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.users.groups.invalid.in_ids',
            ],
        ],
        'name' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.users.groups.invalid.name',
            ],
        ],
        'name_contains' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.users.groups.invalid.name_contains',
            ],
        ],
        'descriptions_contains' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.users.groups.invalid.descriptions_contains',
            ],
        ],
        'status' => [
            'rules'  => 'in_list[ACTIVE,INACTIVE]|permit_empty',
            'errors' => [
                'in_list' => 'Api.users.groups.invalid.status',
            ],
        ],
        'created_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.users.groups.invalid.created_at',
            ],
        ],
        'updated_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.users.groups.invalid.updated_at',
            ],
        ],
    ];
}
