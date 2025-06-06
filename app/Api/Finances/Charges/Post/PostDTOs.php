<?php

namespace App\Api\Finances\Charges\Post;

trait PostDTOs
{
    protected array $rules = [
        'title'      => [
            'label'  => 'title',
            'rules'  => 'string|permit_empty',
        ],
        'description' => [
            'label'  => 'description',
            'rules'  => 'string|permit_empty',
        ],
        'service_id' => [
            'label'  => 'service_id',
            'rules'  => 'integer|required',
        ],
        'privacy' => [
            'label'  => 'privacy',
            'rules'  => 'string|in_list[PUBLIC, PRIVATE]|required',
        ],
        'type' => [
            'label'  => 'type',
            'rules'  => 'string|in_list[APPELLANT, PUNCTUAL]|required',
        ],
        'amount' => [
            'label'  => 'amount',
            'rules'  => 'integer|required',
        ],
        'price' => [
            'label'  => 'price',
            'rules'  => 'integer|required',
        ],
        'promotional_price' => [
            'label'  => 'promotional_price',
            'rules'  => 'integer|permit_empty',
        ],
        'expired_at' => [
            'label' => 'expired_at',
            'rules' => 'string|permit_empty'
        ],
        'clients' => [
            'label'  => 'clients',
            'rules'  => 'permit_empty',
        ]
    ];
}
