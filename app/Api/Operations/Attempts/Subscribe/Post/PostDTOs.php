<?php

namespace App\Api\Operations\Attempts\Subscribe\Post;

trait PostDTOs
{
    protected array $rules = [
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
