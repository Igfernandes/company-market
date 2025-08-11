<?php

namespace App\Api\Operations\Finances\Charges\Delete;

trait DeleteDTOs
{
    protected array $rules = [
        'charge_id'     => [
            'rules' => 'integer|permit_empty',
            'errors' => [
                'string' => 'Api.charges.invalid.charge_id',
            ],
        ],
        "in_charges"    => 'permit_empty'
    ];
}
