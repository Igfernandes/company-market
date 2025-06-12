<?php

namespace App\Api\Users\Groups\Put;

trait PutDTOs
{
    protected array $rules = [
        'name' => [
            'rules'  => 'string|max_length[100]|required',
            'errors' => [
                'string'     => 'Api.users.groups.invalid.name',
                'max_length' => 'Api.users.groups.invalid.name_max_length_100',
                'required'   => 'Api.users.groups.invalid.name',
            ],
        ],
        'description' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.users.groups.invalid.description',
            ],
        ],
        'permissions' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Api.users.groups.invalid.permissions',
            ],
        ],
    ];
}
