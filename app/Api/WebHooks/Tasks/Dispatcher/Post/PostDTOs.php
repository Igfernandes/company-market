<?php

namespace App\Api\Webhooks\Tasks\Dispatcher\Post;

trait PostDTOs
{
    protected array $rules = [
        'k' => [
            'rules'  => 'string|required',
            'errors' => [
                'string'   => 'Api.webhooks.tasks.dispatcher.invalid.k',
                'required' => 'Api.webhooks.tasks.dispatcher.invalid.k',
            ],
        ],
    ];
}
