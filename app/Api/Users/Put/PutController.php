<?php

namespace App\Api\Users\Put;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class PutController extends BaseController
{
    use Validation, ExceptionApi, PutDTOs;

    private PutUseCases $putUseCases;

    public function __construct()
    {
        $this->putUseCases = new PutUseCases();
        helper('crypto');
    }

    public function handle(int $userId = 0)
    {
        try {
            $validation = \Config\Services::validation();

            $payload = $this->request->getVar(array_keys($this->rules));
            $payload['id'] = $userId;

            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $responsePut = $this->putUseCases->execute($payload);

            return $this->response->setJSON($responsePut)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
