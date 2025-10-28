<?php

namespace App\Api\Operations\Companies\Delete;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsValidationBusiness;
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

    public function handle(int $companyId = 0)
    {
        try {
            PermissionsValidationBusiness::hasPermissionUserAuth([
                'scope' => 'companies',
                'type' => 'DELETE'
            ]);

            $validation = \Config\Services::validation();

            $validation->setRules($this->rules);
            $payload = (array)$this->request->getVar();

            if ($companyId > 0)
                $payload["company_id"] = $companyId;

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $responseDelete = $this->deleteUseCases->execute($payload);

            return $this->response->setJSON($responseDelete)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
