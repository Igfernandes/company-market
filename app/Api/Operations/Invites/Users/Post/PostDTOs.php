<?php

namespace App\Api\Operations\Invites\Users\Post;

trait PostDTOs
{
    protected array $rules = [
        'name' => [
            'rules' => 'string|max_length[100]|required',
            'errors' => [
                'string' => 'Api.invites.invalid.name',
                'max_length' => 'Api.invites.invalid.name_max_length_100',
                'required' => 'Api.invites.invalid.name',
            ],
        ],
        'email' => [
            'rules' => 'string|valid_email|max_length[255]|required',
            'errors' => [
                'string' => 'Api.invites.invalid.email',
                'valid_email' => 'Api.invites.invalid.email',
                'max_length' => 'Api.invites.invalid.email_max_length_255',
                'required' => 'Api.invites.invalid.email',
            ],
        ]
    ];
}
