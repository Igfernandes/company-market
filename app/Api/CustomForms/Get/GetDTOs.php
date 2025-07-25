<?php

namespace App\Api\CustomForms\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules' => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.custom_forms.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules' => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.custom_forms.invalid.in_ids',
            ],
        ],
        'name' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.custom_forms.invalid.name',
            ],
        ],
        'name_contains' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.custom_forms.invalid.name_contains',
            ],
        ],
        'slug' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.custom_forms.invalid.slug',
            ],
        ],
        'slug_contains' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.custom_forms.invalid.slug_contains',
            ],
        ],
        'type' => [
            'rules' => 'string|in_list[PEOPLE, COMPANY]|permit_empty',
            'errors' => [
                'string'   => 'Api.custom_forms.invalid.type',
                'in_list'  => 'Api.custom_forms.invalid.type',
            ],
        ],
        'description_contains' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.custom_forms.invalid.description_contains',
            ],
        ],
        'status' => [
            'rules' => 'in_list[ACTIVE, INACTIVE]|permit_empty',
            'errors' => [
                'in_list' => 'Api.custom_forms.invalid.status',
            ],
        ],
        'service_id' => [
            'rules' => 'integer|permit_empty',
            'errors' => [
                'in_list' => 'Api.custom_forms.invalid.service_id',
            ],
        ],
        'created_at' => [
            'rules' => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.custom_forms.invalid.created_at',
            ],
        ],
        'updated_at' => [
            'rules' => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.custom_forms.invalid.updated_at',
            ],
        ],
    ];
}
