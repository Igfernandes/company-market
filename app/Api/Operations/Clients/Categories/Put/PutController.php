<?php

namespace App\Api\Operations\Clients\Categories\Put;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsValidationBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use CodeIgniter\HTTP\Response;
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

    public function handle(int $id)
    {
        try {
            PermissionsValidationBusiness::hasPermissionUserAuth([
                'scope' => 'clients',
                'type' => 'VIEW'
            ]);
            $validation = \Config\Services::validation();

            $payload = (array)$this->request->getJSON();
            $payload['id'] = $id;

            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), Response::HTTP_BAD_REQUEST);

            $responsePut = $this->putUseCases->execute($payload);

            return $this->response->setJSON($responsePut)->setStatusCode(Response::HTTP_OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
