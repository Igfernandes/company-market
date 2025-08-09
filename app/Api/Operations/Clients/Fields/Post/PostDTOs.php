<?php

namespace App\Api\Operations\Clients\Fields\Post;

trait PostDTOs
{
    protected array $rules = [
        'client' => [
            'rules' => 'integer',
            'errors' => [
                'integer' => 'Api.clients.fields.invalid.client_id',
            ],
        ],
    ];
}
