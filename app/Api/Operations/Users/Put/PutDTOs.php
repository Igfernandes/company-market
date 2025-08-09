<?php

namespace App\Api\Operations\Users\Put;

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
