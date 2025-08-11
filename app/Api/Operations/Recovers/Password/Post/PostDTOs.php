<?php

namespace App\Api\Operations\Recovers\Password\Post;

trait PostDTOs
{
    protected array $rules = [
        'email' => [
            'rules' => 'string|valid_email|max_length[255]|required',
            'errors' => [
                'string'      => 'Api.recovers.password.invalid.email',
                'valid_email' => 'Api.recovers.password.invalid.email',
                'max_length'  => 'Api.recovers.password.invalid.email_max_length_255',
                'required'    => 'Api.recovers.password.invalid.email',
            ],
        ],
    ];
}
