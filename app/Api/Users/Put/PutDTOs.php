<?php

namespace App\Api\Users\Put;

trait PutDTOs
{
    protected array $rules = [
        'name' => [
            'rules'  => 'string|required',
            'errors' => [
                'string'   => 'Api.users.invalid.name',
                'required' => 'Api.users.invalid.name',
            ],
        ],
        'email' => [
            'rules'  => 'string|valid_email|max_length[255]|required',
            'errors' => [
                'string'      => 'Api.users.invalid.email',
                'valid_email' => 'Api.users.invalid.email',
                'max_length'  => 'Api.users.invalid.email_max_length_255',
                'required'    => 'Api.users.invalid.email',
            ],
        ],
        'phone' => [
            'rules'  => 'string|max_length[35]|required',
            'errors' => [
                'string'     => 'Api.users.invalid.phone',
                'max_length' => 'Api.users.invalid.phone_max_length_35',
                'required'   => 'Api.users.invalid.phone',
            ],
        ],
    ];
}
