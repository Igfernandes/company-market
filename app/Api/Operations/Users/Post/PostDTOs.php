<?php

namespace App\Api\Operations\Users\Post;

trait PostDTOs
{
    protected array $rules = [
        'document' => [
            'rules'  => 'string|max_length[50]|required',
            'errors' => [
                'string'      => 'Api.users.invalid.document',
                'max_length'  => 'Api.users.invalid.document',
                'required'    => 'Api.users.invalid.document',
            ],
        ],
        'birthdate' => [
            'rules'  => 'valid_date|required',
            'errors' => [
                'valid_date'   => 'Api.users.invalid.birthdate',
                'required' => 'Api.users.invalid.birthdate',
            ],
        ],
        'token' => [
            'rules'  => 'string|required',
            'errors' => [
                'string'   => 'Api.users.invalid.token',
                'required' => 'Api.users.invalid.token',
            ],
        ],
        'password' => [
            'rules'  => 'string|regex_match[' . VALIDATE_PASSWORD . ']|required',
            'errors' => [
                'string'      => 'Api.users.invalid.password',
                'regex_match' => 'Api.users.invalid.password',
                'required'    => 'Api.users.invalid.password',
            ],
        ],
    ];
}
