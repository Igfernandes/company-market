<?php

namespace App\Api\Operations\Webhooks\Tasks\Charge\Post;

trait PostDTOs
{
    protected array $rules = [
        'k' => [
            'rules'  => 'string|required',
            'errors' => [
                'string'   => 'Api.webhooks.tasks.charge.invalid.k',
                'required' => 'Api.webhooks.tasks.charge.invalid.k',
            ],
        ],
    ];
}
