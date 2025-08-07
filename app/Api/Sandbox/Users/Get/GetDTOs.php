<?php

namespace App\Api\Sandbox\Users\Get;

trait GetDTOs
{
    protected array $rules = [
        'current' => [
            'rules'  => 'in_list[0,1]|permit_empty',
            'errors' => [
                'in_list' => 'Api.users.invalid.current',
            ],
        ],
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.users.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.users.invalid.in_ids',
            ],
        ],
        'name' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.users.invalid.name',
            ],
        ],
        'cpf' => [
            'rules'  => 'string|regex_match[' . VALIDATE_CPF_CNPJ . ']|permit_empty',
            'errors' => [
                'string'      => 'Api.users.invalid.cpf',
                'regex_match' => 'Api.users.invalid.cpf',
            ],
        ],
        'phone' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.users.invalid.phone',
            ],
        ],
        'birthdate' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.users.invalid.birthdate',
            ],
        ],
        'status' => [
            'rules'  => 'in_list[ACTIVE, INACTIVE]|permit_empty',
            'errors' => [
                'in_list' => 'Api.users.invalid.status',
            ],
        ],
        'created_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.users.invalid.created_at',
            ],
        ],
        'updated_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.users.invalid.updated_at',
            ],
        ],
    ];
}
