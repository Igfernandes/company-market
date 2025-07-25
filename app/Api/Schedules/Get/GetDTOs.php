<?php

namespace App\Api\Schedules\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'label'  => 'id',
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.schedules.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'label'  => 'in_ids',
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.schedules.invalid.in_ids',
            ],
        ],
        'name' => [
            'label'  => 'name',
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.schedules.invalid.name',
            ],
        ],
        'name_contains' => [
            'label'  => 'name_contains',
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.schedules.invalid.name_contains',
            ],
        ],
        'type' => [
            'label'  => 'type',
            'rules'  => 'string|in_list[APPELLANT,PUNCTUAL]|permit_empty',
            'errors' => [
                'string'  => 'Api.schedules.invalid.type',
                'in_list' => 'Api.schedules.invalid.type',
            ],
        ],
        'description_contains' => [
            'label'  => 'description_contains',
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.schedules.invalid.description_contains',
            ],
        ],
        'status' => [
            'label'  => 'status',
            'rules'  => 'string|in_list[ACTIVE,INACTIVE]|permit_empty',
            'errors' => [
                'string'  => 'Api.schedules.invalid.status',
                'in_list' => 'Api.schedules.invalid.status',
            ],
        ],
        'privacy' => [
            'label'  => 'privacy',
            'rules'  => 'string|in_list[PUBLIC,PRIVATE]|permit_empty',
            'errors' => [
                'string'  => 'Api.schedules.invalid.privacy',
                'in_list' => 'Api.schedules.invalid.privacy',
            ],
        ],
        'created_at' => [
            'label'  => 'created_at',
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.schedules.invalid.created_at',
            ],
        ],
        'updated_at' => [
            'label'  => 'updated_at',
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.schedules.invalid.updated_at',
            ],
        ],
    ];
}
