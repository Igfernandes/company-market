<?php

namespace App\Api\Operations\Authentications\Auth;

trait PostDTOs
{
    protected array $rules = [
        'login' => [
            'rules'  => 'string|required|regex_match[' . VALIDATE_EMAIL . ']',
            'errors' => [
                'string' => 'Api.invalid.email',
                'required' => 'Api.invalid.email',
                'regex_match' => 'Api.invalid.email',
            ],
        ],
        'password' => [
            'rules'  => 'string|required|regex_match[' . VALIDATE_PASSWORD . ']',
            'errors' => [
                'string' => 'Api.auth.invalid.credentials',
                'string' => 'Api.auth.invalid.credentials',
                'regex_match' => 'Api.auth.invalid.credentials'
            ],
        ],
        'remember-me' => [
            'rules'  => 'in_list[0,1]|permit_empty',
            'errors' => [
                'in_list' => 'Api.auth.invalid.rememberMe',
            ],
        ],
        'recaptcha' => [
            'rules'  => 'string|required',
            'errors' => [
                'string' => 'Api.invalid.recaptcha',
                'required' => 'Api.invalid.recaptcha',
            ],
        ]
    ];
}
