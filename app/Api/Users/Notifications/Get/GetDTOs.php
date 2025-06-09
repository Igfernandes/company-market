<?php

namespace App\Api\Users\Notifications\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'label'  => 'id',
            'rules'  => 'integer|permit_empty'
        ],
        'in_ids.*' => [
            'label'  => 'in_ids',
            'rules'  => 'numeric|permit_empty',
        ],
        'user_id' => [
            'label'  => 'user_id',
            'rules'  => 'numeric|permit_empty',
        ],
    ];
}
