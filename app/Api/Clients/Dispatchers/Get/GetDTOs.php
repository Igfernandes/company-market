<?php

namespace App\Api\Clients\Dispatchers\Get;

trait GetDTOs
{
    protected array $rules = [
        'id'            => 'integer|permit_empty',
        'status'        => 'string|in_list[ACTIVE,INACTIVE]|permit_empty',
        'client_id'     => 'integer|permit_empty',
        'message_id'    => 'integer|permit_empty'
    ];
}
