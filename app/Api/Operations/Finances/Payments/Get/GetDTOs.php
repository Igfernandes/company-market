<?php

namespace App\Api\Operations\Finances\Payments\Get;

trait GetDTOs
{
    protected array $rules = [
        'id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.payments.invalid.id',
            ],
        ],
        'in_ids.*' => [
            'rules'  => 'numeric|permit_empty',
            'errors' => [
                'numeric' => 'Api.payments.invalid.in_ids',
            ],
        ],
        'payment_id' => [
            'rules'  => 'string|permit_empty',
            'errors' => [
                'string' => 'Api.payments.invalid.payment_id',
            ],
        ],
        'charge_id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.payments.invalid.charge_id',
            ],
        ],
        'client_id' => [
            'rules'  => 'integer|permit_empty',
            'errors' => [
                'integer' => 'Api.payments.invalid.client_id',
            ],
        ],
        'status' => [
            'rules'  => 'string|in_list[PAID,PENDENT,CANCELED]|permit_empty',
            'errors' => [
                'string'  => 'Api.payments.invalid.status',
                'in_list' => 'Api.payments.invalid.status',
            ],
        ],
        'created_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.payments.invalid.created_at',
            ],
        ],
        'updated_at' => [
            'rules'  => 'valid_date|permit_empty',
            'errors' => [
                'valid_date' => 'Api.payments.invalid.updated_at',
            ],
        ],
    ];
}
