<?php

namespace App\Api\Recover\Password\Put;

trait PutDTOs
{
    protected array $rules = [
        'recover_token' => [
            'label'  => 'recover_token|max_length[50]',
            'rules'  => 'string|required'
        ],
        'password' => [
            'label'  => 'password',
            'rules'  => 'string|required|regex_match[' . VALIDATE_PASSWORD . ']',
        ]
    ];
}
