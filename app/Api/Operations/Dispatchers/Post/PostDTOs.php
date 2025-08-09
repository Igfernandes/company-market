<?php

namespace App\Api\Operations\Dispatchers\Post;

trait PostDTOs
{
    protected array $rules = [
        'title' => [
            'rules' => 'string|required',
            'errors' => [
                'string'   => 'Api.dispatchers.invalid.title',
                'required' => 'Api.dispatchers.invalid.title',
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
            'rules' => 'required',
            'errors' => [
                'required' => 'Api.dispatchers.invalid.platforms',
            ],
        ],
        'service_id' => [
            'rules' => 'integer|permit_empty',
            'errors' => [
                'integer'  => 'Api.dispatchers.invalid.service_id'
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
