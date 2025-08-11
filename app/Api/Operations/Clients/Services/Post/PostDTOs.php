<?php

namespace App\Api\Operations\Clients\Services\Post;

trait PostDTOs
{
    protected array $rules = [
        'client_ids' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Api.clients.invalid.id',
            ],
        ],
        'service_id' => [
            'rules' => 'integer|required',
            'errors' => [
                'integer'  => 'Api.services.invalid.id',
                'required' => 'Api.services.invalid.id',
            ],
        ],
    ];
}
