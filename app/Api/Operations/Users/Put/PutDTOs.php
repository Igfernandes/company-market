<?php

namespace App\Api\Operations\Users\Put;

trait PutDTOs
{
    protected array $rules = [
        'name' => [
            'rules'  => 'string|required|min_length[3]|max_length[100]',
            'errors' => [
                'string'   => 'Api.users.invalid.name',
                'required' => 'Api.users.invalid.name',
            ],
        ],
        'phone' => [
            'rules'  => 'string|min_length[4]|max_length[25]|required',
            'errors' => [
                'string'     => 'Api.users.invalid.phone',
                'max_length' => 'Api.users.invalid.phone',
                'required'   => 'Api.users.invalid.phone',
            ],
        ],
        'birthdate' => [
            'rules'  => 'string|max_length[11]|required',
            'errors' => [
                'string'     => 'Api.users.invalid.birthdate',
                'max_length' => 'Api.users.invalid.birthdate',
                'required'   => 'Api.users.invalid.birthdate',
            ],
        ],
        'status' => [
            'rules'  => 'string|in_list[ACTIVE, INACTIVE]|required',
            'errors' => [
                'string'     => 'Api.users.invalid.status',
                'in_list' => 'Api.users.invalid.status',
                'required'   => 'Api.users.invalid.status',
            ],
        ],
        'document' => [
            'rules'  => 'string|min_length[4]|max_length[20]|required',
            'errors' => [
                'string'     => 'Api.users.invalid.document',
                'max_length' => 'Api.users.invalid.document',
                'required'   => 'Api.users.invalid.document',
            ],
        ],
        'keyword' => [
            'rules'  => 'string|max_length[20]|permit_empty',
            'errors' => [
                'string'     => 'Api.users.invalid.keyword',
                'max_length' => 'Api.users.invalid.keyword',
                'required'   => 'Api.users.invalid.keyword',
            ],
        ],
        'email' => [
            'rules'  => 'string|required|regex_match[' . VALIDATE_EMAIL . ']',
            'errors' => [
                'string' => 'Api.invalid.email',
                'required' => 'Api.invalid.email',
                'regex_match' => 'Api.invalid.email',
            ],
        ],
    ];
}
