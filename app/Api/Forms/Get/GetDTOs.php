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
        'slug' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.forms.invalid.id',
            ],
        ],
        
    ];
}
