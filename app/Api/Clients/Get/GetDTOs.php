<?php

namespace App\Api\Clients\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'label'  => 'id',
            'rules'  => 'integer|permit_empty'
        ],
        'in_ids.*' => [
            'label'  => 'in_ids',
            'rules'  => 'numeric|permit_empty',
        ],
        'name' => [
            'label'  => 'name',
            'rules'  => 'string|permit_empty',
        ],
        'phone' => [
            'label'  => 'phone',
            'rules'  => 'string|permit_empty',
        ],
        'birthdate' => [
            'label'  => 'birthdate',
            'rules'  => 'valid_date|permit_empty',
        ],
        'status' =>  [
            'label'  => 'status',
            'rules'  => 'in_list[ACTIVE, INACTIVE]|permit_empty',
        ],
        'created_at' => [
            'label'  => 'created_at',
            'rules'  => 'valid_date|permit_empty',
        ],
        'updated_at' => [
            'label'  => 'updated_at',
            'rules'  => 'valid_date|permit_empty',
        ]
    ];
}
