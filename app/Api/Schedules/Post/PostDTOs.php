<?php

namespace App\Api\Schedules\Post;

trait PostDTOs
{
    protected array $rules = [
        'title' => [
            'label'  => 'title',
            'rules'  => 'string|required',
            'errors' => [
                'string'   => 'Api.schedules.invalid.title',
                'required' => 'Api.schedules.invalid.title',
            ],
        ],
        'color' => [
            'label'  => 'color',
            'rules'  => 'string|required',
            'errors' => [
                'string'   => 'Api.schedules.invalid.color',
                'required' => 'Api.schedules.invalid.color',
            ],
        ],
        'describe' => [
            'label'  => 'describe',
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.schedules.invalid.describe',
            ],
        ],
        'date' => [
            'label'  => 'date',
            'rules'  => 'string|required',
            'errors' => [
                'string'   => 'Api.schedules.invalid.date',
                'required' => 'Api.schedules.invalid.date',
            ],
        ],
        'end_date' => [
            'label'  => 'end_date',
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.schedules.invalid."end_date"',
            ],
        ],
        'linked' => [
            'label'  => 'linked',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Api.schedules.invalid.linked',
            ],
        ],
    ];
}
