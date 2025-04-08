<?php

namespace App\Api\Recover\Password\Post;

trait PostDTOs
{
    protected array $rules = [
        'email'     => 'string|valid_email|max_length[255]|permit_empty',
    ];
}
