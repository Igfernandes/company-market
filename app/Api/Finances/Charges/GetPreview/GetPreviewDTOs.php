<?php

namespace App\Api\Finances\Charges\GetPreview;

trait GetPreviewDTOs
{
    protected array $rules = [
        'title'      => [
            'label'  => 'title',
            'rules'  => 'string|permit_empty',
        ],
        'service_id' => [
            'label'  => 'int',
            'rules'  => 'integer|permit_empty',
        ],
        'reference' => [
            'label'  => 'int',
            'rules'  => 'string|permit_empty',
        ]
    ];
}
