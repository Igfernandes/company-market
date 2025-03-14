<?php

namespace App\Api\Clients\Delete;

trait DeleteDTOs
{
    protected array $rules = [
        'client_id'     => 'integer|permit_empty',
        "in_clients"    => 'permit_empty'
    ];
}
