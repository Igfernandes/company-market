<?php

namespace App\Api\Operations\Users\Groups\Post;

trait PostDTOs
{
    protected array $rules = [
        'name' => [
            'rules'  => 'string|max_length[100]|required|is_unique[groups.name]',
            'errors' => [
                'string'     => 'Api.users.groups.invalid.name',
                'max_length' => 'Api.users.groups.invalid.name_max_length_100',
                'required'   => 'Api.users.groups.invalid.name',
                'is_unique'  => 'Api.users.groups.invalid.name_unique',
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
