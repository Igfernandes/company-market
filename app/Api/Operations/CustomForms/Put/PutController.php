<?php

namespace App\Api\Operations\CustomForms\Put;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsBusiness;
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
    }

    public function handle(int $customFormId = 0)
    {
        try {
            PermissionsBusiness::hasPermissionUserAuth([
                'scope' => 'forms',
                'type' => 'UPDATE'
            ]);
            $validation = \Config\Services::validation();

            $payload = $this->request->getVar(array_keys($this->rules));
            $payload['id'] = $customFormId;

            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $responsePut = $this->putUseCases->execute($payload);

            return $this->response->setJSON($responsePut)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
