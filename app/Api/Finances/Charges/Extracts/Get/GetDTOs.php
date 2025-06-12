<?php

namespace App\Api\Finances\Charges\Extracts\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|required',
            'errors' => [
                'integer' => 'Api.charges.invalid.id',
                'required' => 'Api.charges.required.id',
            ],
        ],
        'payment_id' => [
            'rules'  => 'integer|required',
            'errors' => [
                'integer' => 'Api.charges.invalid.payment_id',
                'required' => 'Api.charges.required.payment_id',
            ],
        ],
    ];
}
