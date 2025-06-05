<?php

namespace App\Api\WebHooks\Meta\Get;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Controllers\BaseController;
use App\Database\Entities\Reports\OperationFailureEntity;
use App\Libraries\Cerberus\Cerberus;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class GetController extends BaseController
{
    use Validation, ExceptionApi;

    private GetUseCases $getUseCases;

    public function __construct()
    {
        $this->getUseCases = new GetUseCases();
    }

    public function handle()
    {
        $payload = $this->request->getVar();
        try {

            $responseGet = $this->getUseCases->execute($payload);

            return $this->response->setJSON($responseGet)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            if (isset($data->action) && !empty($data->action)) {
                $operationFailure = new OperationFailureEntity();

                $operationFailure->store([
                    'operation_type'     => "Received Token",
                    'provider'           => "META",
                    'error_code'         => $err->getCode(),
                    'error_message'      => $err->getMessage(),
                    'response_received'  => \json_encode($err),
                    'payload_sent'       => $payload,
                    'attempt_number'     => 0,
                    'should_retry'       => true,
                    'status'             => "PENDING",
                ]);
                Cerberus::report($operationFailure);
            }

            return $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
