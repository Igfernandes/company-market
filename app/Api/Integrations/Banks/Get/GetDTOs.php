<?php

namespace App\Api\Integrations\Banks\Get;

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
        'type'       => 'in_list[MERCADO_PAGO]|permit_empty',
        'created_at'  => [
            'label'  => 'created_at',
            'rules'  => 'valid_date|permit_empty',
        ]
    ];
}
