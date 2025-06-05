<?php

namespace App\Api\Webhooks\Tasks\Dispatcher\Post;

trait PostDTOs
{
    protected array $rules = [
        'k'     => 'string|required'
    ];
}
