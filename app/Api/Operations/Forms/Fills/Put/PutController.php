<?php

namespace App\Api\Operations\Forms\Fills\Put;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class PutController extends BaseController
{
    use Validation, ExceptionApi;

    private PutUseCases $putUseCases;
    protected $helpers = ['recaptcha'];

    public function __construct()
    {
        $this->putUseCases = new PutUseCases();
    }

    public function handle(int $formId, string $package)
    {
        try {
            $payload = [
                "formId" => $formId,
                "package" => $package
            ];
            $payload['fields'] = $this->request->getVar();

            $responsePut = $this->putUseCases->execute($payload);

            return $this->response->setJSON($responsePut)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
