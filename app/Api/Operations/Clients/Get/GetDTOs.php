<?php

namespace App\Api\Operations\Clients\Get;

trait GetDTOs
{
    protected array $rules = [
        'in_ids.*' => [
            'rules' => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.clients.invalid.in_ids',
            ],
        ],
        'name' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.clients.invalid.name',
            ],
        ],
        'phone' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.clients.invalid.phone',
            ],
        ],
        'birthdate' => [
            'rules' => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.clients.invalid.birthdate',
            ],
        ],
        'status' => [
            'rules' => 'in_list[ACTIVE, INACTIVE]|permit_empty',
            'errors' => [
                'in_list' => 'Api.clients.invalid.status',
            ],
        ],
        'created_at' => [
            'rules' => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.clients.invalid.created_at',
            ],
        ],
        'updated_at' => [
            'rules' => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.clients.invalid.updated_at',
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
