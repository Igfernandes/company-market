<?php

namespace App\Api\Services\Post;

trait PostDTOs
{
    protected array $rules = [
        'file' => [
            'rules'  => 'uploaded[photo]|max_size[photo,1024]|mime_in[photo,image/png,image/jpeg]|permit_empty',
            'errors' => [
                'uploaded' => 'Api.services.invalid.photo',
                'max_size' => 'Api.services.invalid.photo_max_size_1024',
                'mime_in'  => 'Api.services.invalid.photo_mime_type',
            ],
        ],
        'name' => [
            'rules'  => 'string|required',
            'errors' => [
                'string'   => 'Api.services.invalid.name',
                'required' => 'Api.services.invalid.name',
            ],
        ],
        'description' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.services.invalid.description',
            ],
        ],
        'alerts' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.services.invalid.alerts',
            ],
        ],
        'stock' => [
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
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'string' => 'Api.services.invalid.realized_at',
            ],
        ],
        'expired_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'string' => 'Api.services.invalid.expired_at',
            ],
        ],
    ];
}
