<?php

namespace App\Api\Invites\Users\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.invites.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.invites.invalid.in_ids',
            ],
        ],
        'email' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.invites.invalid.email',
            ],
        ],
        'email_contains' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.invites.invalid.email_contains',
            ],
        ],
        'is_valid' => [
            'rules'  => 'in_list[0, 1]|permit_empty',
            'errors' => [
                'in_list' => 'Api.invites.invalid.is_valid',
            ],
        ],
        'created_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.invites.invalid.created_at',
            ],
        ],
        'expired_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.invites.invalid.expired_at',
            ],
        ],
    ];
}
