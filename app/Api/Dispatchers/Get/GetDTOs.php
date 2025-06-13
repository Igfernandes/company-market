<?php

namespace App\Api\Dispatchers\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules' => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.dispatchers.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules' => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.dispatchers.invalid.in_ids',
            ],
        ],
        'title' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.dispatchers.invalid.title',
            ],
        ],
        'weekday' => [
            'rules' => 'permit_empty',
            'errors' => [],
        ],
        'period' => [
            'rules' => 'string|in_list[DAILY, WEEKLY, MONTHLY]|permit_empty',
            'errors' => [
                'string'  => 'Api.dispatchers.invalid.period',
                'in_list' => 'Api.dispatchers.invalid.period',
            ],
        ],
        'content' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.dispatchers.invalid.content',
            ],
        ],
        'platforms' => [
            'rules' => 'permit_empty',
            'errors' => [],
        ],
        'service_id' => [
            'rules' => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.dispatchers.invalid.service_id',
            ],
        ],
        'scheduled_day' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.dispatchers.invalid.scheduled_day',
            ],
        ],
        'started_at' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.dispatchers.invalid.started_at',
            ],
        ],
        'charge_id' => [
            'rules' => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.dispatchers.invalid.charge_id',
            ],
        ],
        'clients' => [
            'rules' => 'permit_empty',
            'errors' => [],
        ],
    ];
}
