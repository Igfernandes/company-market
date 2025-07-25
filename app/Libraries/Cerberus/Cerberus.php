<?php

namespace App\Libraries\Cerberus;

use App\Database\Entities\Reports\SettingsHistoryEntity;
use App\Database\Entities\Reports\OperationFailureEntity;
use App\Database\Models\Reports\OperationFailuresModel;
use App\Database\Models\Reports\SettingsHistoryModel;
use App\Libraries\Exceptions\Exceptions;

class Cerberus
{

    public function storeIntegrations(SettingsHistoryEntity $settingsHistory): bool|null
    {
        $settingsHistoryModel = new SettingsHistoryModel();

        $settingsHistoryModel->upsert([
            "module" =>  $settingsHistory->getModule(),
            "operation" => $settingsHistory->getOperation()
        ], $settingsHistory);

        return true;
    }

    public static function report(OperationFailureEntity $operationFailure): bool
    {
        $operationFailureModel = new OperationFailuresModel();
        $where = [
            'operation_type'     => $operationFailure->getOperationType(),
            'provider'           => $operationFailure->getProvider(),
            'payload_sent'       => $operationFailure->getPayloadSent(),
            'response_received'  => $operationFailure->getResponseReceived(),
        ];
        $filteredWhere = \array_filter($where, fn($field) => !empty($field));

        /** @var OperationFailureEntity */
        $foundOperation = $operationFailureModel->where($filteredWhere)->first();

        if (!empty($foundOperation) && $foundOperation->getAttemptNumber() > ATTEMPT_CHANCES)
            throw new Exceptions($operationFailure->getErrorMessage(), \FORBIDDEN_ERROR);

        if (!empty($foundOperation)) {
            $operationFailureModel->set(["attempt_number" => $foundOperation->getAttemptNumber() + 1])->update($foundOperation->getId());
        }

        $operationFailureModel->save($operationFailure);
        return true;
    }
}
