<?php

namespace App\Api\Operations\Webhooks\WhatsApp\Post;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Controllers\BaseController;
use App\Database\Entities\Reports\OperationFailureEntity;
use App\Libraries\Cerberus\Cerberus;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class PostController extends BaseController
{
    use Validation, ExceptionApi;

    private PostUseCases $postUseCases;

    public function __construct()
    {
        $this->postUseCases = new PostUseCases();
        helper('crypto');
    }

    public function handle()
    {
        $payload = $this->request->getVar();
        try {

            $responsePost = $this->postUseCases->execute($payload);

            return $this->response->setJSON($responsePost)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            if (isset($data->action) && !empty($data->action)) {
                $operationFailure = new OperationFailureEntity();

                $operationFailure->store([
                    'operation_type'     => "Received PSID",
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
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
