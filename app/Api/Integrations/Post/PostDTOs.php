<?php

namespace App\Api\Integrations\Post;

trait PostDTOs
{
    protected array $rules = [
        'type' => [
            'rules'  => 'string|required',
            'errors' => [
                'string' => 'Api.integrations.invalid.type',
                'required' => 'Api.integrations.invalid.type',
            ],
        ],
        'provider' => [
            'rules'  => 'string|required',
            'errors' => [
                'string' => 'Api.integrations.invalid.provider',
                'required' => 'Api.integrations.invalid.provider',
            ],
        ],
        'public_token' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.integrations.invalid.public_token',
            ],
        ],
        'private_token' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.integrations.invalid.private_token',
            ],
        ],
        'status' => [
            'rules'  => 'in_list[ACTIVE,INACTIVE]|permit_empty',
            'errors' => [
                'in_list' => 'Api.integrations.invalid.status',
            ],
        ],
        'username' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.integrations.invalid.username',
            ],
        ],
    ];
}
