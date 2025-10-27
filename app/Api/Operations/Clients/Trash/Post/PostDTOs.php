<?php

namespace App\Api\Operations\Clients\Trash\Post;

trait PostDTOs
{
    protected array $rules = [
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.clients.invalid.in_ids',
            ],
        ],
    ];
}
