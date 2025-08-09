<?php

namespace App\Api\Operations\Notifications\Subscribes\Post;

trait PostDTOs
{
    protected array $rules = [
        'phone' => [
            'rules'  => 'string|required',
            'errors' => [
                'string' => 'Api.subscribes.invalid.phone',
                'max_length' => 'Api.subscribes.invalid.phone_max_length_35',
            ],
        ],
        'type' => [
            'rules'  => 'string|required',
            'errors' => [
                'string'   => 'Api.subscribes.invalid.type',
                'in_list'  => 'Api.subscribes.invalid.type',
                'required' => 'Api.subscribes.invalid.type',
            ],
        ],
        'data' => [
            'rules'  => 'string|required',
            'errors' => [
                'string' => 'Api.subscribes.invalid.data',
                'string' => 'Api.subscribes.invalid.data',
            ],
        ],
    ];
}
