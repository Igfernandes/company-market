<?php

namespace App\Api\Notifications\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.notifications.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.notifications.invalid.in_ids',
            ],
        ],
        'author_id' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.notifications.invalid.author_id',
            ],
        ],
    ];
}
