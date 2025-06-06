<?php

namespace App\Api\Invites\Users\Post;

trait PostDTOs
{
    protected array $rules = [
        'name'      => 'string|max_length[100]|required',
        'email'     => 'string|valid_email|max_length[255]|required',
        'phone'     => 'string|required',
        'group'     => 'permit_empty'
    ];
}
