<?php

namespace App\Api\Finances\OperationsFailures\Get;

use App\Database\Entities\Reports\OperationFailureEntity;
use App\Database\Models\Reports\OperationFailuresModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\OperationsFailures\OperationsFailuresDataTrait;

class GetUseCases
{
    use OperationsFailuresDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     operation_type: string,
     *     error_message: string,
     *     error_code: int, 
     *     status: 'PENDING'| 'RETRYING' | 'FAILED' | 'RESOLVED',
     *     resolved_at: string, 
     *     created_at: string, 
     *     updated_at: string 
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $operationsFailuresModel = new OperationFailuresModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        if (count($in_ids) > 0)
            $operationsFailuresModel->whereIn("id", $in_ids);

        $operationsFailuresModel = $this->builderClauseWithContains($payload, $operationsFailuresModel);

        $operationsFailures = $operationsFailuresModel->where($filteredPayload)->findAll();

        if (\count($operationsFailures) == 0) return [];

        if (!empty($payload['id']) && count($operationsFailures) > 0)
            return $this->builder($operationsFailures[0]);
        else if (!empty($payload['id']) && \count($operationsFailures) == 0)
            throw new Exceptions(lang("Errors.not_found"), \NOT_FOUND);

        $operationsFailuresData = array_map(
            fn(OperationFailureEntity $operationFailure) => $this->builder($operationFailure),
            $operationsFailures
        );

        return \array_values($operationsFailuresData);
    }
}
