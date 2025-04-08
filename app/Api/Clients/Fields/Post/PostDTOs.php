<?php

namespace App\Api\Clients\Fields\Post;

trait PostDTOs
{
    protected array $rules = [
        'client' => 'numeric',
    ];
}
