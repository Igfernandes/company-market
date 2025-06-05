<?php

namespace App\Api\MessagesDispatcher\Put;

trait PutDTOs
{
    protected array $rules = [
        'id'        => 'integer|required',
        'clients'    => 'permit_empty',
        'status'     => 'string|required',
    ];
}
