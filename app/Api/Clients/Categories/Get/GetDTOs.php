<?php

namespace App\Api\Clients\Categories\Get;

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
        'client_id' => [
            'label'  => 'id',
            'rules'  => 'integer|permit_empty'
        ],
        'name' => [
            'label'  => 'name',
            'rules'  => 'string|permit_empty',
        ],
        'name_contains' => [
            'label'  => 'name',
            'rules'  => 'string|permit_empty',
        ],
        'description_contains' => [
            'label'  => 'name',
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
