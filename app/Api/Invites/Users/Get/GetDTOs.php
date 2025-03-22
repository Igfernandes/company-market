<?php

namespace App\Api\Invites\Users\Get;

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
        'email' => [
            'label'  => 'name',
            'rules'  => 'string|permit_empty',
        ],
        'email_contains' => [
            'label'  => 'phone',
            'rules'  => 'string|permit_empty',
        ],
        'is_valid' =>  [
            'label'  => 'status',
            'rules'  => 'in_list[0, 1]|permit_empty',
        ],
        'created_at' => [
            'label'  => 'created_at',
            'rules'  => 'valid_date|permit_empty',
        ],
        'expired_at' => [
            'label'  => 'updated_at',
            'rules'  => 'valid_date|permit_empty',
        ]
    ];
}
