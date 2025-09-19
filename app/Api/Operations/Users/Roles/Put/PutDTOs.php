<?php

namespace App\Api\Operations\Users\Roles\Put;

trait PutDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'numeric|required',
            'errors' => [
                'string' => 'Api.roles.invalid.id',
            ],
        ],
        'name' => [
            'rules'  => 'string|required|max_length[100]',
            'errors' => [
                'string' => 'Api.roles.invalid.name',
                'max_length' => 'Api.roles.invalid.name',
            ],
        ],
        'description' => [
            'rules'  => 'string|permit_empty|max_length[255]',
            'errors' => [
                'string'      => 'Api.roles.invalid.description',
                'max_length' => 'Api.roles.invalid.description',
            ],
        ]
    ];
}
