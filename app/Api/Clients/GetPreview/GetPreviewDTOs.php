<?php

namespace App\Api\Clients\GetPreview;

trait GetPreviewDTOs
{
    protected array $rules = [
        'phone' => [
            'rules' => 'string|required',
            'errors' => [
                'string'  => 'Api.clients.invalid.phone',
                'required' => 'Api.clients.invalid.phone',
            ],
        ],
    ];
}
