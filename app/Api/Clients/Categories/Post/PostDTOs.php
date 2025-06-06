<?php

namespace App\Api\Clients\Categories\Post;

trait PostDTOs
{
    protected array $rules = [
        'categories' => 'required',
    ];
}
