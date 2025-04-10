<?php

namespace App\Api\Integrations\Chats\Post;

trait PostDTOs
{
    protected array $rules = [
        'type'              => 'in_list[FACEBOOK,INSTAGRAM,WHATSAPP]|required',
        'public_token'      => 'string|permit_empty',
        'private_token'     => 'string|permit_empty',
        'username'          => 'string|permit_empty',
        'login'             => 'string|permit_empty',
        'password'          => 'string|permit_empty'
    ];
}
