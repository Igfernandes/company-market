<?php

namespace App\Api\Operations\Users\Roles\Permissions\Post;

trait PostDTOs
{
    protected array $rules = [
        'role_id' => [
            'rules'  => 'required',
            'errors' => [
                'string' => 'Api.users.invalid.name',
            ],
        ],
        'ids' => [
            'rules'  => 'required',
            'errors' => [
                'string' => 'Api.users.invalid.required',
            ],
        ]
    ];
}
