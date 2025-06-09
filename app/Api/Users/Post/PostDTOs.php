<?php

namespace App\Api\Users\Post;

trait PostDTOs
{
    protected array $rules = [
        'cpf'       => 'string|max_length[100]|required|regex_match[' . VALIDATE_CPF_CNPJ . ']',
        'birthdate' => 'string|required',
        'keyword'   => 'string|required',
        'password'  => 'string|regex_match[' . VALIDATE_PASSWORD . ']|required'
    ];
}
