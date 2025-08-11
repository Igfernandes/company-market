<?php

namespace App\Api\Operations\Finances\OperationsFailures\Get;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class GetController extends BaseController
{
    use Validation, ExceptionApi, GetDTOs;

    private GetUseCases $getUseCases;

    public function __construct()
    {
        $this->getUseCases = new GetUseCases();
    }

    public function handle(Int $chargeId = 0)
    {
        try {
            PermissionsBusiness::hasPermissionUserAuth([
                'scope' => 'integrations',
                'type' => 'VIEW'
            ]);
            $validation = \Config\Services::validation();

            $payload = $this->request->getVar(array_keys($this->rules));
            $validation->setRules($this->rules);

            if ($chargeId > 0)
                $payload['id'] = $chargeId;

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $responseGet = $this->getUseCases->execute($payload);

            return $this->response->setJSON($responseGet)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
