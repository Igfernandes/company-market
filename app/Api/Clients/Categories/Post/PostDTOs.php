<?php

namespace App\Api\Clients\Categories\Post;

trait PostDTOs
{
    protected array $rules = [
        'categories' => [
            "rules" => 'required',
            'errors' => [
                'required' => 'Api.clients.categories.invalid.categories',
            ],
        ],

    ];
}
