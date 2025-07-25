<?php

namespace App\Api\Forms\Fills\Get;

trait GetDTOs
{
    protected array $rules = [
        'form_id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.forms.invalid.form_id',
            ],
        ],
    ];
}
