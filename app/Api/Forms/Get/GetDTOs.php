<?php

namespace App\Api\Forms\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.forms.invalid.id',
            ],
        ],
    ];
}
