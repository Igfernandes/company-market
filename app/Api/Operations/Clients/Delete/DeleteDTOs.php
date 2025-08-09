<?php

namespace App\Api\Operations\Clients\Delete;

trait DeleteDTOs
{
    protected array $rules = [
        'client_id'     => [
            "rules" => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.clients.invalid.client',
            ],
        ],
        "in_clients" => 'permit_empty'
    ];
}
