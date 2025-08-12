<?php

namespace App\Api\Operations\Schedules\Put;

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

    public function handle(int $scheduleId)
    {
        try {
            PermissionsBusiness::hasPermissionUserAuth([
                'scope' => 'schedules',
                'type' => 'UPDATE'
            ]);
            $validation = \Config\Services::validation();

            $payload = $this->request->getVar(array_keys($this->rules));
            $validation->setRules($this->rules);

            $payload['id'] = $scheduleId;

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
