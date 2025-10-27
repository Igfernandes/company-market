<?php

namespace App\Api\Operations\Companies\Get;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsValidationBusiness;
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

    public function handle(int $companyId = 0)
    {
        try {
            PermissionsValidationBusiness::hasPermissionUserAuth([
                'scope' => 'companies',
                'type' => 'VIEW'
            ]);

            $validation = \Config\Services::validation();

            $payload = $this->request->getVar(array_keys($this->rules));
            $validation->setRules($this->rules);

            if ($companyId > 0)
                $payload['id'] = $companyId;

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $payload = PermissionsValidationBusiness::applyOwnershipRestriction([
                'scope' => 'companies',
                'type' => 'VIEW'
            ], $payload);

            $responseGet = $this->getUseCases->execute($payload);

            return $this->response->setJSON($responseGet)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
