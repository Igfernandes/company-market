<?php

namespace App\Api\Operations\Clients\Trash\Delete;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsValidationBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use CodeIgniter\HTTP\Response;
use Exception;

class DeleteController extends BaseController
{
    use Validation, ExceptionApi, ControllersTrait;

    private DeleteUseCases $deleteUseCases;

    public function __construct()
    {
        $this->deleteUseCases = new DeleteUseCases();
    }

    public function handle(int $id = 0)
    {
        try {
            PermissionsValidationBusiness::hasPermissionUserAuth([
                'scope' => 'clients',
                'type' => 'DELETE'
            ]);
            $payload['id'] = $id;

            $responseDelete = $this->deleteUseCases->execute($payload);

            return $this->response->setJSON($responseDelete)->setStatusCode(Response::HTTP_OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
