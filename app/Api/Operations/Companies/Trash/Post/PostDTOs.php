<?php

namespace App\Api\Operations\Companies\Trash\Post;

trait PostDTOs
{
    protected array $rules = [
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.companies.invalid.in_ids',
            ],
        ],
    ];
}
