<?php

namespace App\Api\Clients\GetPreview;

trait GetPreviewDTOs
{
    protected array $rules = [
        'phone' => [
            'label'  => 'phone',
            'rules'  => 'string|required',
        ]
    ];
}
