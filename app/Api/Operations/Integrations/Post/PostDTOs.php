<?php

namespace App\Api\Operations\Integrations\Post;

trait PostDTOs
{
    protected array $rules = [
        'company_id' => [
            'rules'  => 'required',
            'errors' => [
                'string' => 'Api.integrations.invalid.company_id',
                'required' => 'Api.integrations.invalid.company_id',
            ],

        ]
    ];
}
