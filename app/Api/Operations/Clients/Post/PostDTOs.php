<?php

namespace App\Api\Operations\Clients\Post;

trait PostDTOs
{
    protected array $rules = [
        'name' => [
            'rules' => 'string|max_length[100]',
            'errors' => [
                'string' => 'Api.clients.invalid.name',
                'max_length' => 'Api.clients.invalid.name_max_length_100',
            ],
        ],
        'avatar' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.clients.invalid.avatar',
            ],
        ],
        'phone' => [
            'rules' => 'string|max_length[35]',
            'errors' => [
                'string' => 'Api.clients.invalid.phone',
                'max_length' => 'Api.clients.invalid.phone_max_length_35',
            ],
        ],
        'email' => [
            'rules' => 'string|valid_email|max_length[255]|permit_empty',
            'errors' => [
                'string' => 'Api.clients.invalid.email',
                'valid_email' => 'Api.clients.invalid.email',
                'max_length' => 'Api.clients.invalid.email_max_length_255',
            ],
        ],
        'birthdate' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.clients.invalid.birthdate',
            ],
        ],
        'category' => [
            'rules' => 'integer',
            'errors' => [
                'integer' => 'Api.clients.invalid.category',
            ],
        ],
    ];
}
