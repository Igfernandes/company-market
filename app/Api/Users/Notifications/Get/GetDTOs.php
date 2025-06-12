<?php

namespace App\Api\Users\Notifications\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'label'  => 'id',
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.users.notifications.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'label'  => 'in_ids',
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.users.notifications.invalid.in_ids',
            ],
        ],
        'user_id' => [
            'label'  => 'user_id',
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.users.notifications.invalid.user_id',
            ],
        ],
    ];
}
