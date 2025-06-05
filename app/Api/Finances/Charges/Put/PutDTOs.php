<?php

namespace App\Api\Finances\Charges\Put;

trait PutDTOs
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
            'rules'  => 'integer|permit_empty',
        ],
        'privacy' => [
            'label'  => 'privacy',
            'rules'  => 'string|in_list[PUBLIC, PRIVATE]|required',
        ],
        'type' => [
            'label'  => 'type',
            'rules'  => 'string|in_list[APPELLANT, PUNCTUAL]|required',
        ],
        'status' => [
            'label'  => 'status',
            'rules'  => 'string|in_list[ACTIVE, INACTIVE]|required',
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
    ];
}
