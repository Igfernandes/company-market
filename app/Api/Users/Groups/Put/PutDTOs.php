<?php

namespace App\Api\Users\Groups\Put;

trait PutDTOs
{
    protected array $rules = [
        'name'      => 'string|max_length[100]|required',
        'description' => 'string|permit_empty',
        'permissions' => 'required'
    ];
}
