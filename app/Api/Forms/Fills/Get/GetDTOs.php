<?php

namespace App\Api\Forms\Fills\Get;

trait GetDTOs
{
    protected array $rules = [
        'form_id' => [
            'label'  => 'id',
            'rules'  => 'integer|permit_empty'
        ],
    ];
}
