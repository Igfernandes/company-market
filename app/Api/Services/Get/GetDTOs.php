<?php

namespace App\Api\Services\Get;

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
        'name_contains' => [
            'label'  => 'name',
            'rules'  => 'string|permit_empty',
        ],
        'type' => [
            'label'  => 'type',
            'rules'  => 'string|in_list[APPELLANT, PUNCTUAL]|permit_empty',
        ],
        'description_contains' => [
            'label'  => 'description',
            'rules'  => 'string|permit_empty',
        ],
        'status' =>  [
            'label'  => 'status',
            'rules'  => 'in_list[ACTIVE, INACTIVE]|permit_empty',
        ],
        'privacy' => [
            'label'  => 'status',
            'rules'  => 'in_list[PUBLIC, PRIVATE]|permit_empty',
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
