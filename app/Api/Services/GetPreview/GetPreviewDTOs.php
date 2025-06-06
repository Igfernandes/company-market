<?php

namespace App\Api\Services\GetPreview;

trait GetPreviewDTOs
{
    protected array $rules = [
        'id' => [
            'label'  => 'id',
            'rules'  => 'integer|permit_empty',
        ],
        'charge' => [
            'label'  => 'charge',
            'rules'  => 'string|permit_empty',
        ],
        'form' => [
            'label'  => 'int',
            'rules'  => 'string|permit_empty',
        ]
    ];
}
