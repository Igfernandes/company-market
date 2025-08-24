<?php

namespace App\Api\Operations\Users\Get;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class GetController extends BaseController
{
    use Validation, ExceptionApi, GetDTOs;

    private GetUseCases $getUseCases;

    public function __construct()
    {
        $this->getUseCases = new GetUseCases();
    }

    public function handle()
    {
        try {

            $validation = \Config\Services::validation();

            $payload = $this->request->getVar(array_keys($this->rules));
            $validation->setRules($this->rules);
            if (isset($payload['current'])) {
                $payload['current']  = $payload['current'] == true ? 1 : 0;
            } else PermissionsBusiness::hasPermissionUserAuth([
                'scope' => 'users',
                'type' => 'VIEW'
            ]);


            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);

            $responseGet = $this->getUseCases->execute($payload);

            return $this->response->setJSON($responseGet)->setStatusCode(ResponseInterface::HTTP_OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
