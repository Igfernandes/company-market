<?php

namespace App\Api\Operations\Users\Post;

trait PostDTOs
{
    protected array $rules = [
        'cpf' => [
            'rules'  => 'string|max_length[100]|required|regex_match[' . VALIDATE_CPF_CNPJ . ']',
            'errors' => [
                'string'      => 'Api.users.invalid.document',
                'max_length'  => 'Api.users.invalid.document',
                'required'    => 'Api.users.invalid.document',
                'regex_match' => 'Api.users.invalid.document',
            ],
        ],
        'birthdate' => [
            'rules'  => 'valid_date|required',
            'errors' => [
                'string'   => 'Api.users.invalid.birthdate',
                'required' => 'Api.users.invalid.birthdate',
            ],
        ],
        'keyword' => [
            'rules'  => 'string|required',
            'errors' => [
                'string'   => 'Api.users.invalid.keyword',
                'required' => 'Api.users.invalid.keyword',
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
