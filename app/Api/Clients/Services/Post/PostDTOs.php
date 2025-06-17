<?php

namespace App\Api\Clients\Services\Post;

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
                'integer'  => 'Api.clients.invalid.id',
                'required' => 'Api.clients.invalid.id',
            ],
        ],
    ];
}