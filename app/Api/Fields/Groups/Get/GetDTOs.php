<?php

namespace App\Api\Fields\Groups\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.fields.groups.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.fields.groups.invalid.in_ids',
            ],
        ],
        'name' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.fields.groups.invalid.name',
            ],
        ],
        'name_contains' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.fields.groups.invalid.name_contains',
            ],
        ],
        'scope' => [
            'rules'  => 'in_list[USER, CLIENT, COMPANY]|permit_empty',
            'errors' => [
                'in_list' => 'Api.fields.groups.invalid.scope',
            ],
        ],
    ];
}
