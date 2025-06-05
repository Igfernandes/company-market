<?php

namespace App\Api\Finances\Charges\Extracts\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'label'  => 'id',
            'rules'  => 'integer|required'
        ],
       'payment_id' => [
            'label' => 'payment_id',
            'rules' => 'integer|required'
       ]
    ];
}
