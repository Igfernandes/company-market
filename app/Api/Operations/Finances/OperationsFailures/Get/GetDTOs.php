<?php

namespace App\Api\Operations\Finances\OperationsFailures\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.operations_failures.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.operations_failures.invalid.in_ids',
            ],
        ],
        'operation_type' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.operations_failures.invalid.operation_type',
            ],
        ],
        'error_message' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.operations_failures.invalid.error_message',
            ],
        ],
        'error_code' => [
            'rules'  => 'string|in_list[ACTIVE, INACTIVE]|permit_empty',
            'errors' => [
                'string'  => 'Api.operations_failures.invalid.error_code',
                'in_list' => 'Api.operations_failures.invalid.error_code',
            ],
        ],
        'status' => [
            'rules'  => 'string|in_list[PENDING, RETRYING, FAILED, RESOLVED]|permit_empty',
            'errors' => [
                'string'  => 'Api.operations_failures.invalid.status',
                'in_list' => 'Api.operations_failures.invalid.status',
            ],
        ],
        'resolved_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.operations_failures.invalid.resolved_at',
            ],
        ],
        'created_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.operations_failures.invalid.created_at',
            ],
        ],
        'updated_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.operations_failures.invalid.updated_at',
            ],
        ],
    ];
}
