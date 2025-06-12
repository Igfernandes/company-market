<?php

namespace App\Api\Finances\Charges\Clients\Post;

trait PostDTOs
{
    protected array $rules = [
        'charge_id' => [
            'rules' => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.charges.invalid.charge_id',
            ],
        ],
        'clients' => [
            'rules' => 'permit_empty',
        ],
    ];
}
