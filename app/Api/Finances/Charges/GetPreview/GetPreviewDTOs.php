<?php

namespace App\Api\Finances\Charges\GetPreview;

trait GetPreviewDTOs
{
    protected array $rules = [
        'title' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.charges.invalid.title',
            ],
        ],
        'service_id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.charges.invalid.service_id',
            ],
        ],
        'reference' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.charges.invalid.reference',
            ],
        ],
    ];
}
