<?php

namespace App\Api\Clients\Services\Get;

trait GetDTOs
{
    protected array $rules = [
        'service_id' => [
            'rules' => 'integer|permit_empty',
            'errors' => [
                'numeric' => 'Api.services.invalid.not_found',
            ],
        ],
    ];
}
