<?php

namespace App\Api\Operations\Permissions\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.permissions.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.permissions.invalid.in_ids',
            ],
        ],
        'name' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.permissions.invalid.name',
            ],
        ],
        'type' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.permissions.invalid.type',
            ],
        ],
        'scope' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.permissions.invalid.scope',
            ],
        ],
    ];
}
