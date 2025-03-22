<?php

namespace App\Api\Users\Groups\Post;

trait PostDTOs
{
    protected array $rules = [
        'name'      => 'string|max_length[100]|required|is_unique[groups.name]',
        'description' => 'string|permit_empty',
        'permissions' => 'required'
    ];
}
