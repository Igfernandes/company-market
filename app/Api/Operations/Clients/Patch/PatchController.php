<?php

namespace App\Api\Operations\Clients\Patch;

use App\Api\Operations\Clients\Patch\Category\PatchCategoryUseCases;
use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use Exception;

class PatchController extends BaseController
{
    use Validation, ExceptionApi, PatchDTOs, ControllersTrait;

    private array $operations = [
        "category" => PatchCategoryUseCases::class
    ];

    public function handle()
    {
        try {
            PermissionsBusiness::hasPermissionUserAuth([
                'scope' => 'clients',
                'type' => 'UPDATE'
            ]);
            $validation = \Config\Services::validation();

            $payload = $this->request->getVar(array_keys($this->rules));
            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $operationClass = $this->operations[$payload['path']];
            $operation = new $operationClass();

            $responsePatch = $operation->execute((array) $payload['data']);

            return $this->response->setJSON($responsePatch)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
