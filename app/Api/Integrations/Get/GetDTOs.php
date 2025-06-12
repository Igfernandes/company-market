<?php

namespace App\Api\Integrations\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.integrations.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.integrations.invalid.in_ids',
            ],
        ],
        'provider' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.integrations.invalid.provider',
            ],
        ],
        'type' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.integrations.invalid.type',
            ],
        ],
        'created_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.integrations.invalid.created_at',
            ],
        ],
    ];
}
