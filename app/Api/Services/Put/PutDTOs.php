<?php

namespace App\Api\Services\Put;

trait PutDTOs
{
    protected array $rules = [
        'name' => [
            'label'  => 'name',
            'rules'  => 'string|required',
            'errors' => [
                'string'   => 'Api.services.invalid.name',
                'required' => 'Api.services.invalid.name',
            ],
        ],
        'type' => [
            'label'  => 'type',
            'rules'  => 'string|in_list[APPELLANT, PUNCTUAL]|required',
            'errors' => [
                'string'   => 'Api.services.invalid.type',
                'in_list'  => 'Api.services.invalid.type',
                'required' => 'Api.services.invalid.type',
            ],
        ],
        'status' => [
            'label'  => 'status',
            'rules'  => 'string|in_list[ACTIVE,INACTIVE]|required',
            'errors' => [
                'string'   => 'Api.services.invalid.status',
                'in_list'  => 'Api.services.invalid.status',
                'required' => 'Api.services.invalid.status',
            ],
        ],
        'description' => [
            'label'  => 'description',
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.services.invalid.description',
            ],
        ],
        'privacy' => [
            'label'  => 'privacy',
            'rules'  => 'in_list[PUBLIC, PRIVATE]|required',
            'errors' => [
                'in_list'  => 'Api.services.invalid.privacy',
                'required' => 'Api.services.invalid.privacy',
            ],
        ],
        'stock' => [
            'label'  => 'stock',
            'rules'  => 'integer|is_natural|permit_empty',
            'errors' => [
                'integer'    => 'Api.services.invalid.stock',
                'is_natural' => 'Api.services.invalid.stock',
            ],
        ],
        'reservations' => [
            'label'  => 'reservations',
            'rules'  => 'integer|is_natural|permit_empty',
            'errors' => [
                'integer'    => 'Api.services.invalid.reservations',
                'is_natural' => 'Api.services.invalid.reservations',
            ],
        ],
        'address' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.services.invalid.address',
            ],
        ],
        'realized_at' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.services.invalid.realized_at',
            ],
        ],
        'expired_at' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.services.invalid.expired_at',
            ],
        ],
    ];
}
