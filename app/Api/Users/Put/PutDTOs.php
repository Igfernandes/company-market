<?php

namespace App\Api\Users\Put;

trait PutDTOs
{
    protected array $rules = [
        'name' => [
            'label'  => 'name',
            'rules'  => 'string|required',
        ],
        'cpf'       => 'string|max_length[100]|required|regex_match[' . VALIDATE_CPF_CNPJ . ']',
        'phone'     => 'string|max_length[100]|required',
        'birthdate' => 'string|valid_date[Y-m-d]|required',
    ];
}
