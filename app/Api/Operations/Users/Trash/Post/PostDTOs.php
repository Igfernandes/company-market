<?php

namespace App\Api\Operations\Users\Trash\Post;

trait PostDTOs
{
    protected array $rules = [
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.users.invalid.in_ids',
            ],
        ],
    ];
}
