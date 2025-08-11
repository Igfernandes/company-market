<?php

namespace App\Api\Operations\CustomForms\Delete;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsBusiness;
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

    public function handle(int $customFormId = 0)
    {
        try {
            PermissionsBusiness::hasPermissionUserAuth([
                'scope' => 'forms',
                'type' => 'DELETE'
            ]);
            $payload['id'] = $customFormId;

            $responsePut = $this->deleteUseCases->execute($payload);

            return $this->response->setJSON($responsePut)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
