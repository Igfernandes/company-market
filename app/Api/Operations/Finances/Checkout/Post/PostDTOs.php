<?php

namespace App\Api\Operations\Finances\Checkout\Post;

trait PostDTOs
{
    protected array $rules = [
        'name' => [
            'rules'  => 'string|max_length[100]',
            'errors' => [
                'string'     => 'Api.checkout.invalid.name',
                'max_length' => 'Api.checkout.invalid.name_max_length_100',
            ],
        ],
        'phone' => [
            'rules'  => 'string|max_length[35]',
            'errors' => [
                'string'     => 'Api.checkout.invalid.phone',
                'max_length' => 'Api.checkout.invalid.phone_max_length_35',
            ],
        ],
        'amounts' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Api.checkout.invalid.amounts',
            ],
        ],
        'email' => [
            'rules'  => 'string|valid_email|max_length[255]|permit_empty',
            'errors' => [
                'string'     => 'Api.checkout.invalid.email',
                'valid_email' => 'Api.checkout.invalid.email',
                'max_length' => 'Api.checkout.invalid.email_max_length_255',
            ],
        ],
        'birthdate' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.checkout.invalid.birthdate',
            ],
        ],
        'product' => [
            'rules'  => 'string|required',
            'errors' => [
                'string'   => 'Api.checkout.invalid.product',
                'required' => 'Api.checkout.invalid.product',
            ],
        ],
        'recaptcha' => [
            'rules'  => 'string',
            'errors' => [
                'string' => 'Api.auth.invalid.recaptcha',
            ],
        ],
    ];
}
