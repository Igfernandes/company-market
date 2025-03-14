<?php

namespace App\Api\Clients\Post;

trait PostDTOs
{
    protected array $rules = [
        'name'      => 'string|max_length[100]',
        'avatar'    => 'string|permit_empty',
        'phone'     => [
            'label'  => 'phone',
            'rules'  => 'string|max_length[35]'
        ],
        'email'     => 'string|valid_email|max_length[255]|permit_empty',
        'birthdate' => 'string|valid_date[Y-m-d]|permit_empty',
        'category'  => 'integer'
    ];
}
