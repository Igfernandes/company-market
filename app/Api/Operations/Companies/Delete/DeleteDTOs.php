<?php

namespace App\Api\Operations\Companies\Delete;

trait DeleteDTOs
{
    protected array $rules = [
        'company_id'     => [
            "rules" => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.companies.invalid.company',
            ],
        ],
        "in_companies" => 'permit_empty'
    ];
}
