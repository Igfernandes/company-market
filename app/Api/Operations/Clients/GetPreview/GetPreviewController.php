<?php

namespace App\Api\Operations\Clients\GetPreview;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class GetPreviewController extends BaseController
{
    use Validation, ExceptionApi, GetPreviewDTOs;

    private GetPreviewUseCases $getPreviewUseCases;

    public function __construct()
    {
        $this->getPreviewUseCases = new GetPreviewUseCases();
        helper('crypto');
    }

    public function handle()
    {
        try {
            $validation = \Config\Services::validation();

            $payload = $this->request->getVar(array_keys($this->rules));
            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $responseGet = $this->getPreviewUseCases->execute($payload);

            return $this->response->setJSON($responseGet)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
