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
        'alerts' => [
            'label'  => 'alerts',
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.services.invalid.alerts',
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
        'gratuity' => [
            'rules'  => 'integer|is_natural|permit_empty',
            'errors' => [
                'integer'    => 'Api.services.invalid.gratuity',
                'is_natural' => 'Api.services.invalid.gratuity',
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
