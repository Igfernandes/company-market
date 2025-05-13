<?php

namespace App\Api\Services\Put;

trait PutDTOs
{
    protected array $rules = [
        'name' => [
            'label'  => 'name',
            'rules'  => 'string|required',
        ],
        'type' => [
            'label'  => 'type',
            'rules'  => 'string|in_list[APPELLANT, PUNCTUAL]|required',
        ],
        'description' => [
            'label'  => 'description',
            'rules'  => 'string|permit_empty',
        ],
        'privacy' => [
            'label'  => 'privacy',
            'rules'  => 'in_list[PUBLIC, PRIVATE]|required',
        ],
        'stock' => [
            'label'  => 'stock',
            'rules'  => 'integer|is_natural|permit_empty',
        ],
        'reservations' => [
            'label'  => 'reservations',
            'rules'  => 'integer|is_natural|permit_empty',
        ]
    ];
}
