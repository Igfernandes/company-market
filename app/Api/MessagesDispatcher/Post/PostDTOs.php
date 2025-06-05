<?php

namespace App\Api\MessagesDispatcher\Post;

trait PostDTOs
{
    protected array $rules = [
        'title'      => [
            'label'  => 'title',
            'rules'  => 'string|required',
        ],
        'weekday' => [
            'label'  => 'weekday',
            'rules'  => 'permit_empty',
        ],
        'period' => [
            'label'  => 'period',
            'rules'  => 'string|in_list[DAILY, WEEKLY, MONTHLY]|permit_empty',
        ],
        'content' => [
            'label'  => 'content',
            'rules'  => 'string|permit_empty',
        ],
        'platforms' => [
            'label'  => 'platforms',
            'rules'  => 'required',
        ],
        'service_id' => [
            'label'  => 'int',
            'rules'  => 'integer|required',
        ],
        'scheduled_day' => [
            'label' => 'scheduled_day',
            'rules' => 'string|permit_empty'
        ],
        'started_at' => [
            'label' => 'started_at',
            'rules' => 'string|permit_empty'
        ],
        'service_id' => [
            'label'  => 'service_id',
            'rules'  => 'integer|permit_empty',
        ],
        'charge_id' => [
            'label'  => 'charge_id',
            'rules'  => 'integer|permit_empty',
        ],
        'clients' => [
            'label'  => 'stock',
            'rules'  => 'permit_empty',
        ]
    ];
}
