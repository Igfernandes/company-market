<?php

namespace App\Api\Charges\Delete;

trait DeleteDTOs
{
    protected array $rules = [
        'charge_id'     => 'integer|permit_empty',
        "in_charges"    => 'permit_empty'
    ];
}
