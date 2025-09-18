<?php

namespace App\Api\Operations\Users\Roles\Permissions\Post;

trait PostDTOs
{
    protected array $rules = [
        'role_id' => [
            'rules'  => 'required',
            'errors' => [
                'string' => 'Api.roles.invalid.id',
            ],
        ],
        'ids' => [
            'rules'  => 'required',
            'errors' => [
                'string' => 'Api.permissions.invalid.in_ids',
            ],
        ]
    ];
}
