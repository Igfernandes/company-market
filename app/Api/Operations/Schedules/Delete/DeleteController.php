<?php

namespace App\Api\Operations\Schedules\Delete;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsValidationBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class DeleteController extends BaseController
{
    use Validation, ExceptionApi;

    private DeleteUseCases $deleteUseCases;

    public function __construct()
    {
        $this->deleteUseCases = new DeleteUseCases();
    }

    public function handle(int $scheduleId)
    {
        try {
            PermissionsValidationBusiness::hasPermissionUserAuth([
                'scope' => 'schedules',
                'type' => 'DELETE'
            ]);
            $payload['id'] = $scheduleId;

            $responseDelete = $this->deleteUseCases->execute($payload);

            return $this->response->setJSON($responseDelete)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
