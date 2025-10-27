<?php

namespace App\Api\Operations\Clients\Put;

trait PutDTOs
{
    protected array $rules = [
        'id' => [
            'rules' => 'integer|required',
            'errors' => [
                'integer'  => 'Api.clients.invalid.id',
                'required' => 'Api.clients.invalid.id',
            ],
        ],
        'name' => [
            'rules' => 'string|max_length[100]',
            'errors' => [
                'string'     => 'Api.clients.invalid.name',
                'max_length' => 'Api.clients.invalid.name',
            ],
        ],
        'status' => [
            'rules'  => 'string|in_list[ACTIVE, INACTIVE]|required',
            'errors' => [
                'string'     => 'Api.clients.invalid.status',
                'in_list' => 'Api.clients.invalid.status',
                'required'   => 'Api.clients.invalid.status',
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
                'string'     => 'Api.clients.invalid.phone',
                'max_length' => 'Api.clients.invalid.phone',
            ],
        ],
        'email' => [
            'rules' => 'string|valid_email|max_length[255]|permit_empty',
            'errors' => [
                'string'      => 'Api.clients.invalid.email',
                'valid_email' => 'Api.clients.invalid.email',
                'max_length'  => 'Api.clients.invalid.email',
            ],
        ],
        'birthdate' => [
            'rules' => 'string|permit_empty|max_length[20]',
            'errors' => [
                'string' => 'Api.clients.invalid.birthdate',
                'max_length' => 'Api.clients.invalid.birthdate'
            ],
        ],
        'category' => [
            'rules' => 'integer|required',
            'errors' => [
                'integer' => 'Api.clients.invalid.category',
            ],
        ],
        'document' => [
            'rules' => 'string|permit_empty|max_length[30]',
            'errors' => [
                'string' => 'Api.clients.invalid.document',
                'max_length' => 'Api.clients.invalid.document'
            ],
        ],
        'document_type' => [
            'rules' => 'string|permit_empty|max_length[35]',
            'errors' => [
                'string' => 'Api.clients.invalid.document_type',
                'max_length' => 'Api.clients.invalid.document_type'
            ],
        ],
    ];
}
