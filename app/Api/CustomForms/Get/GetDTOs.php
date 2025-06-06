<?php

namespace App\Api\CustomForms\Get;

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
        'slug' => [
            'label'  => 'slug',
            'rules'  => 'string|permit_empty',
        ],
        'slug_contains' => [
            'label'  => 'slug',
            'rules'  => 'string|permit_empty',
        ],
        'type' => [
            'label'  => 'type',
            'rules'  => 'string|in_list[PEOPLE, COMPANY]|permit_empty',
        ],
        'description_contains' => [
            'label'  => 'description',
            'rules'  => 'string|permit_empty',
        ],
        'status' =>  [
            'label'  => 'status',
            'rules'  => 'in_list[ACTIVE, INACTIVE]|permit_empty',
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
