<?php

namespace App\Api\Clients\Dispatchers\Get;

trait GetDTOs
{
    protected array $rules = [
        'id'            => [
            "rules" => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.clients.dispatchers.invalid.client',
            ],
        ],
        'status'        => [
            "rules" => 'string|in_list[ACTIVE,INACTIVE]|permit_empty',
            'errors' => [
                'string' => 'Api.clients.dispatchers.invalid.status',
                'in_list' => 'Api.clients.dispatchers.invalid.status',
            ],
        ],
        'client_id'  => [
            "rules" => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.clients.dispatchers.invalid.client_id'
            ],
        ],
        'message_id'    => [
            "rules" => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.clients.dispatchers.invalid.message_id'
            ],
        ]
    ];
}
