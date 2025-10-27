<?php

namespace App\Api\Operations\Companies\Post;

trait PostDTOs
{
    protected array $rules = [
        'name' => [
            'rules' => 'string|max_length[100]',
            'errors' => [
                'string' => 'Api.companies.invalid.name',
                'max_length' => 'Api.companies.invalid.name',
            ],
        ],
        'logotype' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.companies.invalid.logotype',
            ],
        ],
        'status' => [
            'rules'  => 'string|in_list[ACTIVE, INACTIVE]|required',
            'errors' => [
                'string'     => 'Api.companies.invalid.status',
                'in_list' => 'Api.companies.invalid.status',
                'required'   => 'Api.companies.invalid.status',
            ],
        ],
        'phone' => [
            'rules' => 'string|max_length[35]',
            'errors' => [
                'string' => 'Api.companies.invalid.phone',
                'max_length' => 'Api.companies.invalid.phone',
            ],
        ],
        'email' => [
            'rules' => 'string|valid_email|max_length[255]|permit_empty',
            'errors' => [
                'string' => 'Api.companies.invalid.email',
                'valid_email' => 'Api.companies.invalid.email',
                'max_length' => 'Api.companies.invalid.email',
            ],
        ],
        'inscribed_at' => [
            'rules' => 'string|permit_empty|max_length[10]',
            'errors' => [
                'string' => 'Api.companies.invalid.inscribed_at',
                'max_length' => 'Api.companies.invalid.inscribed_at',
            ],
        ],
        'document' => [
            'rules' => 'string|permit_empty|max_length[30]',
            'errors' => [
                'string' => 'Api.companies.invalid.document',
                'max_length' => 'Api.companies.invalid.document'
            ],
        ],
        'document_type' => [
            'rules' => 'string|permit_empty|max_length[35]',
            'errors' => [
                'string' => 'Api.companies.invalid.document_type',
                'max_length' => 'Api.companies.invalid.document_type'
            ],
        ],
    ];
}
