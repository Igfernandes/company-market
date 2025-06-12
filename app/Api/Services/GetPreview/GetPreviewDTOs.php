<?php

namespace App\Api\Services\GetPreview;

trait GetPreviewDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.services.preview.invalid.id',
            ],
        ],
        'charge' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.services.preview.invalid.charge',
            ],
        ],
        'form' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.services.preview.invalid.form',
            ],
        ],
    ];
}
