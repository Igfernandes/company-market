<?php

namespace App\Api\Integrations\Post;

trait PostDTOs
{
    protected array $rules = [
        'type'              => 'string|required',
        'provider'          => 'string|required',
        'public_token'      => 'string|permit_empty',
        'private_token'     => 'string|permit_empty',
        'status'            => 'in_list[ACTIVE,INACTIVE]|permit_empty',
        'username'          => 'string|permit_empty',
    ];
}
