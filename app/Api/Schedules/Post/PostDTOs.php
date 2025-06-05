<?php

namespace App\Api\Schedules\Post;

trait PostDTOs
{
    protected array $rules = [
        'title' => [
            'label'  => 'name',
            'rules'  => 'string|required',
        ],
        'color' => [
            'label'  => 'color',
            'rules'  => 'string|required',
        ],
        'describe' => [
            'label'  => 'type',
            'rules'  => 'string|required',
        ],
        'date' => [
            'label'  => 'date',
            'rules'  => 'string|required',
        ],
        'end_date' => [
            'label'  => 'end_date',
            'rules'  => 'string|permit_empty',
        ],
        'linked' => [
            'required'
        ]
    ];
}
