<?php

namespace App\Api\Authentications\Auth;

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
                'string' => 'Api.auth.invalid.password',
                'string' => 'Api.auth.invalid.password',
                'regex_match' => 'Api.auth.invalid.password'
            ],
        ],
        'rememberMe' => [
            'rules'  => 'in_list[0,1]|',
            'errors' => [
                'in_list' => 'Api.auth.invalid.rememberMe',
            ],
        ],
        // 'recaptcha' => [
        //     'rules'  => 'string',
        //     'errors' => [
        //         'string' => 'Api.auth.invalid.recaptcha',
        //     ],
        // ],
    ];
}
