<?php

namespace App\Api\Operations\Clients\Trash\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.clients.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.clients.invalid.in_ids',
            ],
        ],
        'name' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.clients.invalid.name',
            ],
        ],
        'phone' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.clients.invalid.phone',
            ],
        ],

        'status' => [
            'rules'  => 'permit_empty|in_list[AVAILABLE,MAINTENANCE,UNAVAILABLE]',
            'errors' => [
                'in_list' => 'Api.clients.invalid.status',
            ],
        ],
        'start' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.clients.invalid.start',
            ],
        ],
        'limit' => [
            'rules'  => 'numeric|less_than_equal_to[500]|permit_empty',
            'errors' => [
                'numeric'    => 'Api.clients.invalid.limit',
                'less_than_equal_to' => 'Api.clients.invalid.limit',
            ],
        ],
    ];
}
