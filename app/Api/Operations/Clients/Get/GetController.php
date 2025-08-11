<?php

namespace App\Api\Operations\Clients\Get;

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
        helper('crypto');
    }

    public function handle(int $clientId = 0)
    {
        try {
            $validation = \Config\Services::validation();

            $payload = $this->request->getVar(array_keys($this->rules));
            $validation->setRules($this->rules);

            if ($clientId > 0)
                $payload['id'] = $clientId;

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $payload = PermissionsBusiness::applyOwnershipRestriction([
                'scope' => 'clients',
                'type' => 'VIEW'
            ], $payload);

            $responseGet = $this->getUseCases->execute($payload);

            return $this->response->setJSON($responseGet)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
