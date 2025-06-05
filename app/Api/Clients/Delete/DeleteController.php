<?php

namespace App\Api\Clients\Delete;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use Exception;

class DeleteController extends BaseController
{
    use Validation, ExceptionApi, DeleteDTOs, ControllersTrait;

    private DeleteUseCases $deleteUseCases;

    public function __construct()
    {
        $this->deleteUseCases = new DeleteUseCases();
    }

    public function handle(int $clientId = 0)
    {
        try {
            $validation = \Config\Services::validation();

            $validation->setRules($this->rules);
            $payload = $this->request->getVar(['in_clients']);

            if ($clientId > 0)
                $payload["client_id"] = $clientId;

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $responseDelete = $this->deleteUseCases->execute($payload);

            return $this->response->setJSON($responseDelete)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
