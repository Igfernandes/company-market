<?php

namespace App\Api\Operations\Clients\Categories\Delete;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsValidationBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use Exception;

class DeleteController extends BaseController
{
    use Validation, ExceptionApi, ControllersTrait;

    private DeleteUseCases $deleteUseCases;

    public function __construct()
    {
        $this->deleteUseCases = new DeleteUseCases();
    }

    public function handle(int $clientId = 0)
    {
        try {
            PermissionsValidationBusiness::hasPermissionUserAuth([
                'scope' => 'clients',
                'type' => 'DELETE'
            ]);
            $payload['id'] = $clientId;

            $responseDelete = $this->deleteUseCases->execute($payload);

            return $this->response->setJSON($responseDelete)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
