<?php

namespace App\Api\Operations\Users\Roles\Post;

trait PostDTOs
{
    protected array $rules = [
        'name' => [
            'rules'  => 'string|required|max_length[100]',
            'errors' => [
                'string' => 'Api.roles.invalid.name',
            ],
        ],
        'description' => [
            'rules'  => 'string|permit_empty|max_length[255]',
            'errors' => [
                'string'      => 'Api.roles.invalid.description',
                'regex_match' => 'Api.roles.invalid.description',
            ],
        ]
    ];
}
