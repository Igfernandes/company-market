<?php

namespace App\Api\Finances\OperationsFailures\Get;

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
        'operation_type' => [
            'label'  => 'operation_type',
            'rules'  => 'string|permit_empty',
        ],
        'error_message' => [
            'label'  => 'error_message',
            'rules'  => 'string|permit_empty',
        ],
        'error_code' => [
            'label'  => 'error_code',
            'rules'  => 'string|in_list[ACTIVE, INACTIVE]|permit_empty',
        ],
        'status' => [
            'label'  => 'status',
            'rules'  => 'string|in_list[PENDING, RETRYING, FAILED, RESOLVED]|permit_empty',
        ],
        'resolved_at' => [
            'label'  => 'resolved_at',
            'rules'  => 'valid_date|permit_empty',
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
