<?php

namespace App\Api\Operations\Finances\OperationsFailures\Post;

use App\Api\Operations\WebHooks\MercadoPago\Post\PostUseCases as PostPostUseCases;
use App\Database\Entities\Reports\OperationFailureEntity;
use App\Database\Models\Reports\OperationFailuresModel;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class PostUseCases
{
    /**
     * @param array{
     *   id: int,
     * } $payload
     */
    public function execute(array $payload)
    {

        $operationsFailuresModel = new OperationFailuresModel();
        try {

            /** @var OperationFailureEntity */
            $foundOperation = $operationsFailuresModel->where('id', $payload['id'])->first();

            if (empty($foundOperation))
                throw new Exceptions("Api.operations_failures.invalid.not_found", BAD_REQUEST);

            $payloadSent = $foundOperation->getPayloadSent();

            if (empty($payload)) {
                $operationsFailuresModel->where('id', $payload['id'])->delete();
                throw new Exceptions("Api.operations_failures.invalid.operation_failed", OK);
            }

            $MercadoPagoUseCase = new PostPostUseCases();

            $payloadDecode = json_decode($payloadSent);
            $MercadoPagoUseCase->execute($payloadDecode);

            $operationsFailuresModel->set(["status" => "RESOLVED", "resolved_at" => date('Y-m-d H:i:s')])->where("id", $payload['id'])->update();

            return (object)[
                "success" => "Api.operations_failures.success.post",
            ];
        } catch (Exception $err) {
            // \var_dump($err);
            $operationsFailuresModel->where('id', $payload['id'])->delete();
            return [
                "success" => "Api.operations_failures.invalid.operation_failed"
            ];
        }
    }
}
