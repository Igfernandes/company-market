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
            'label'  => 'int',
            'rules'  => 'integer|required',
        ],
        'type' => [
            'label'  => 'type',
            'rules'  => 'string|in_list[APPELLANT, PUNCTUAL]|required',
        ],
        'price' => [
            'label'  => 'description',
            'rules'  => 'string|required',
        ],
        'promotional_price' => [
            'label'  => 'privacy',
            'rules'  => 'string|permit_empty',
        ],
        'clients' => [
            'label'  => 'stock',
            'rules'  => 'permit_empty',
        ]
    ];
}
