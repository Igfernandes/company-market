<?php

namespace App\Services\MercadoPago\Constants;

class ReportsUserConstants
{
    public static array $NOT_FOUND_USER = [
        'operation_type'     => "setting.webhook.payment",
        'provider'           => "MERCADO_PAGO",
        'error_message'      => "NOT_FOUND_MERCADO_PAGO_USER",
        'error_code'         => \NOT_FOUND,
        'attempt_number'     => 0,
        'payload_sent'       => null,
        'should_retry'       => true,
        'status'             => "PENDING",
    ];
}
