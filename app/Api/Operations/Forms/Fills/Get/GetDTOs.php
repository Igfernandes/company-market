<?php

namespace App\Api\Operations\Forms\Fills\Get;

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
