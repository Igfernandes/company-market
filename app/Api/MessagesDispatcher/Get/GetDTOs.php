<?php

namespace App\Api\MessagesDispatcher\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'label'  => 'id',
            'rules'  => 'integer|permit_empty'
        ],
        'in_ids.*' => [
            'label'  => 'in_ids',
            'rules'  => 'numeric|permit_empty',
        ],
        'title'      => [
            'label'  => 'title',
            'rules'  => 'string|permit_empty',
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
            'rules'  => 'permit_empty',
        ],
        'service_id' => [
            'label'  => 'int',
            'rules'  => 'integer|permit_empty',
        ],
        'scheduled_at' => [
            'label' => 'scheduled_at',
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
