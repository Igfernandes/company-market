<?php

namespace App\Api\Operations\Invites\Users\Post;

trait PostDTOs
{
    protected array $rules = [
        'name' => [
            'rules' => 'string|max_length[100]|required',
            'errors' => [
                'string' => 'Api.invites.invalid.name',
                'max_length' => 'Api.invites.invalid.name',
                'required' => 'Api.invites.invalid.name',
            ],
        ],
        'email' => [
            'rules' => 'string|valid_email|max_length[255]|required',
            'errors' => [
                'string' => 'Api.invites.invalid.email',
                'valid_email' => 'Api.invites.invalid.email',
                'max_length' => 'Api.invites.invalid.email',
                'required' => 'Api.invites.invalid.email',
            ],
        ]
    ];
}
