<?php

namespace App\Api\Finances\Checkout\Post;

trait PostDTOs
{
    protected array $rules = [
        'name'      => 'string|max_length[100]',
        'phone'     => [
            'label'  => 'phone',
            'rules'  => 'string|max_length[35]'
        ],
        'amounts' => 'required',
        'email'     => 'string|valid_email|max_length[255]|permit_empty',
        'birthdate' => 'string|valid_date[Y-m-d]|permit_empty',
        'product' => "string|required",
        'g-recaptcha-response' => [
            'label'  => 'g-recaptcha-response',
            'rules'  => 'string',
            'errors' => [
                'string' => 'Validation.string',
            ],
        ],
    ];
}
