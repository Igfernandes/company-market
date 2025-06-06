<?php

namespace App\Api\Finances\Payments\Get;

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
        'payment_id'      => [
            'label'  => 'payment_id',
            'rules'  => 'string|permit_empty',
        ],
        'charge_id' => [
            'label'  => 'charge_id',
            'rules'  => 'integer|permit_empty',
        ],
        'client_id' => [
            'label'  => 'client_id',
            'rules'  => 'integer|permit_empty',
        ],
        'status' => [
            'label'  => 'status',
            'rules'  => 'string|in_list[PAID,PENDENT,CANCELED]|permit_empty',
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
