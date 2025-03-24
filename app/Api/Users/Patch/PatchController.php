<?php

namespace App\Api\Users\Patch;

use App\Api\ExceptionApi;
use App\Api\Users\Patch\Status\PatchStatusUseCases;
use App\Api\Validation;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use Exception;

class PatchController extends BaseController
{
    use Validation, ExceptionApi, ControllersTrait, PatchDTOs;

    private PatchStatusUseCases $patchStatusUseCases;

    public function __construct()
    {
        $this->patchStatusUseCases = new PatchStatusUseCases();
    }

    public function handle(int $userId = 0)
    {
        try {
            $payload = (array) $this->request->getVar();

            $operation = $payload['operation'];
            $validation = \Config\Services::validation();

            $payload['id'] = $userId;
            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            if ($operation == "status")
                $responsePatch = $this->patchStatusUseCases->execute($payload);
            else throw new Exceptions(lang("Errors.not_found"), \NOT_FOUND);

            return $this->response->setJSON($responsePatch)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
