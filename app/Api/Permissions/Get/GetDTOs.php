<?php

namespace App\Api\Permissions\Get;

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
        'name' => [
            'label'  => 'name',
            'rules'  => 'string|permit_empty',
        ],
        'type' => [
            'label'  => 'type',
            'rules'  => 'string|permit_empty',
        ],
        'scope' => [
            'label'  => 'scope',
            'rules'  => 'string|permit_empty',
        ]
    ];
}
