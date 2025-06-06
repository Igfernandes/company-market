<?php

namespace App\Api\Finances\Charges\Get;

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
        'title'      => [
            'label'  => 'title',
            'rules'  => 'string|permit_empty',
        ],
        'description' => [
            'label'  => 'description',
            'rules'  => 'string|permit_empty',
        ],
        'status' => [
            'label'  => 'status',
            'rules'  => 'string|in_list[ACTIVE, INACTIVE]|permit_empty',
        ],
        'service_id' => [
            'label'  => 'int',
            'rules'  => 'integer|permit_empty',
        ],
        'type' => [
            'label'  => 'type',
            'rules'  => 'string|in_list[APPELLANT, PUNCTUAL]|permit_empty',
        ],
        'price' => [
            'label'  => 'description',
            'rules'  => 'string|permit_empty',
        ],
        'promotional_price' => [
            'label'  => 'privacy',
            'rules'  => 'string|permit_empty',
        ],
        'created_at' => [
            'label'  => 'created_at',
            'rules'  => 'valid_date|permit_empty',
        ],
        'updated_at' => [
            'label'  => 'updated_at',
            'rules'  => 'valid_date|permit_empty',
        ]
    ];
}
