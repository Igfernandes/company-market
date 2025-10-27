<?php

namespace App\Api\Operations\Attempts\Contact\Post;

trait PostDTOs
{
    protected array $rules = [
        'name' => [
            'rules' => 'string|required',
            'errors' => [
                'string'   => 'Api.custom_forms.invalid.name',
                'required' => 'Api.custom_forms.invalid.name',
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
        'subject' => [
            'rules' => 'string|required',
            'errors' => [
                'string'   => 'Api.custom_forms.invalid.subject',
                'required' => 'Api.custom_forms.invalid.subject',
            ],
        ],
        'message' => [
            'rules' => 'string|required',
            'errors' => [
                'string'   => 'Api.custom_forms.invalid.message',
                'required' => 'Api.custom_forms.invalid.message',
            ],
        ],
    ];
}
