<?php

namespace App\Api\Finances\Charges\Post;

trait PostDTOs
{
    protected array $rules = [
        'title' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.charges.invalid.title',
            ],
        ],
        'description' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.charges.invalid.description',
            ],
        ],
        'service_id' => [
            'rules'  => 'integer|required',
            'errors' => [
                'integer' => 'Api.charges.invalid.service_id',
                'required' => 'Api.charges.invalid.service_id',
            ],
        ],
        'privacy' => [
            'rules'  => 'string|in_list[PUBLIC, PRIVATE]|required',
            'errors' => [
                'string' => 'Api.charges.invalid.privacy',
                'in_list' => 'Api.charges.invalid.privacy',
                'required' => 'Api.charges.invalid.privacy',
            ],
        ],
        'type' => [
            'rules'  => 'string|in_list[APPELLANT, PUNCTUAL]|required',
            'errors' => [
                'string' => 'Api.charges.invalid.type',
                'in_list' => 'Api.charges.invalid.type',
                'required' => 'Api.charges.invalid.type',
            ],
        ],
        'amount' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.charges.invalid.amount',
            ],
        ],
        'period' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.charges.invalid.period',
            ],
        ],
        'started_at' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.charges.invalid.started_at',
            ],
        ],
        'price' => [
            'rules'  => 'integer|required',
            'errors' => [
                'integer' => 'Api.charges.invalid.price',
                'required' => 'Api.charges.invalid.price',
            ],
        ],
        'promotional_price' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.charges.invalid.promotional_price',
            ],
        ],
        'expired_days' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.charges.invalid.expired_days',
            ],
        ],
        'clients' => [
            'rules'  => 'permit_empty',
        ],
    ];
}
