<?php

namespace App\Api\Operations\Users\Permissions\Post;

trait PostDTOs
{
    protected array $rules = [
        'user_id' => [
            'rules'  => 'numeric|required',
            'errors' => [
                'numeric' => 'Api.users.invalid.id',
                'required' => 'Api.users.invalid.id',
            ],
        ],
        'permissions' => [
            'rules'  => 'required',
            'errors' => [
                'string' => 'Api.permissions.invalid.in_ids',
            ],
        ]
    ];
}
