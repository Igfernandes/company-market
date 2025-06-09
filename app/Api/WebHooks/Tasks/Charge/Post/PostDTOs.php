<?php

namespace App\Api\Webhooks\Tasks\Charge\Post;

trait PostDTOs
{
    protected array $rules = [
        'k'     => 'string|required'
    ];
}
