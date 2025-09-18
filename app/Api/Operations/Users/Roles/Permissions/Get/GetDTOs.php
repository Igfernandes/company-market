<?php

namespace App\Api\Operations\Users\Roles\Permissions\Get;

trait GetDTOs
{
    protected array $rules = [
        'role_id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.roles.invalid.role_id',
            ],
        ],
    ];
}
