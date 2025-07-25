<?php

namespace App\Api\WebHooks\MercadoPago\Post;

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
    }

    public function handle()
    {
        $json = file_get_contents('php://input');
        try {

            $data = json_decode($json);

            if (empty($data))
                throw new Exceptions("Api.webhooks.not_found", \NOT_FOUND);

            $responsePost = $this->postUseCases->execute($data);

            return $this->response->setJSON($responsePost)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {
            $data = json_decode($json);

            if (isset($data->action) && !empty($data->action)) {
                $operationFailure = new OperationFailureEntity();

                $operationFailure->store([
                    'operation_type'     => $data->action ?? "none",
                    'provider'           => "MERCADO_PAGO",
                    'error_code'         => $err->getCode(),
                    'error_message'      => $err->getMessage(),
                    'response_received'  => \json_encode($err),
                    'payload_sent'       => $json,
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
