<?php

namespace App\Api\Users\Groups\Patch;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use Exception;

class PatchController extends BaseController
{
    use Validation, ExceptionApi, ControllersTrait;

    private PatchUseCases $patchUseCases;

    public function __construct()
    {
        $this->patchUseCases = new PatchUseCases();
    }

    public function handle(int $groupId = 0)
    {
        try {
            $payload['id'] = $groupId;

            $responsePatch = $this->patchUseCases->execute($payload);

            return $this->response->setJSON($responsePatch)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
