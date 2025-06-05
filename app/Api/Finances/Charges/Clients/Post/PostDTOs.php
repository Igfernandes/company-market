<?php

namespace App\Api\Finances\Charges\Clients\Post;

trait PostDTOs
{
    protected array $rules = [
        'charge_id'      => [
            'label'  => 'title',
            'rules'  => 'string|permit_empty',
        ],
        'clients' => [
            'label'  => 'stock',
            'rules'  => 'permit_empty',
        ]
    ];
}
