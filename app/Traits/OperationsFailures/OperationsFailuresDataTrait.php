<?php

namespace App\Traits\OperationsFailures;

use App\Database\Entities\Reports\OperationFailureEntity;

trait OperationsFailuresDataTrait
{
    public function builder(OperationFailureEntity $operationFailure): Object
    {
        return  (object)[
            "id" => $operationFailure->getId(),
            "operation_type" => $operationFailure->getOperationType(),
            "provider" => $operationFailure->getProvider(),
            "error_message" => $operationFailure->getErrorMessage(),
            "error_code" => $operationFailure->getErrorCode(),
            "payload_sent" => $operationFailure->getPayloadSent(),
            "response_received" => $operationFailure->getResponseReceived(),
            "attempt_number" => $operationFailure->getAttemptNumber(),
            "should_retry" => $operationFailure->getShouldRetry(),
            "status" => $operationFailure->getStatus(),
            "resolved_at" => $operationFailure->getResolvedAt(),
            "created_at" => $operationFailure->getCreatedAt(),
            "updated_at" => $operationFailure->getUpdatedAt()
        ];
    }
}
