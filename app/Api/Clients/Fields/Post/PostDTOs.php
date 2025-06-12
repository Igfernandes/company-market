<?php

namespace App\Api\Clients\Fields\Post;

trait PostDTOs
{
    protected array $rules = [
        'client' => [
            'rules' => 'integer',
            'errors' => [
                'integer' => 'Api.clients.fields.invalid.client',
            ],
        ],
    ];
}
