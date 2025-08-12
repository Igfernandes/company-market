<?php

namespace App\Api\Operations\Services\Put;

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
    protected $helpers = ['uploads'];

    public function __construct()
    {
        $this->putUseCases = new PutUseCases();
    }

    public function handle(int $serviceId = 0)
    {
        try {
            PermissionsBusiness::hasPermissionUserAuth([
                'scope' => 'services',
                'type' => 'UPDATE'
            ]);
            $validation = \Config\Services::validation();

            $payload = $this->request->getVar(array_keys($this->rules));
            $payload['id'] = $serviceId;

            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $photo = $this->request->getVar('photo');
            if (!empty($photo))
                $payload['photo'] = $photo;

            $responsePut = $this->putUseCases->execute($payload);

            return $this->response->setJSON($responsePut)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {
            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
