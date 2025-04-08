<?php

namespace App\Api\Authentications\Auth;

trait PostDTOs
{
    protected array $rules = [
        'login' => [
            'label'  => 'email',
            'rules'  => 'string|required|regex_match[' . VALIDATE_EMAIL . ']',
            'errors' => [
                'required' => 'Validation.invalid_email',
                'regex_match' => 'Validation.invalid_email'
            ],
        ],
        'password' => [
            'label'  => 'password',
            'rules'  => 'string|required|regex_match[' . VALIDATE_PASSWORD . ']',
            'errors' => [
                'string' => 'Validation.string'
            ],
        ],
        'rememberMe' => [
            'label'  => 'rememberMe',
            'rules'  => 'in_list[0,1]|',
            'errors' => [
                'string' => 'Validation.string',
            ],
        ],
        'g-recaptcha-response' => [
            'label'  => 'g-recaptcha-response',
            'rules'  => 'string',
            'errors' => [
                'string' => 'Validation.string',
            ],
        ],
    ];
}
