<?php

namespace App\Api\Users\Put;

trait PutDTOs
{
    protected array $rules = [
        'name' => [
            'label'  => 'name',
            'rules'  => 'string|required',
        ],
        'email'     => 'string|valid_email|max_length[255]|required',
        'phone'     => 'string|max_length[100]|required'
    ];
}
