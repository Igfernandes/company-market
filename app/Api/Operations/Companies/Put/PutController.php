<?php

namespace App\Api\Operations\Companies\Put;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsValidationBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use Exception;

class PutController extends BaseController
{
    use Validation, ExceptionApi, PutDTOs, ControllersTrait;

    private PutUseCases $putUseCases;

    public function __construct()
    {
        $this->putUseCases = new PutUseCases();
        helper('crypto');
    }

    public function handle(int $companyId)
    {
        try {
            PermissionsValidationBusiness::hasPermissionUserAuth([
                'scope' => 'companies',
                'type' => 'UPDATE'
            ]);
            $validation = \Config\Services::validation();

            $allPayload = $this->request->getJSON() ?? [];
            $payload = array_intersect_key((array)$allPayload, array_flip(array_keys($this->rules)));
            $validation->setRules($this->rules);

            $payload['id'] = $companyId;

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $responsePost = $this->putUseCases->execute($payload);

            return $this->response->setJSON($responsePost)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
