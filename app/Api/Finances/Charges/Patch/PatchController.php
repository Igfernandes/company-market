<?php

namespace App\Api\Users\Patch;

use App\Api\ExceptionApi;
use App\Api\Users\Patch\ProductsId\ProductsIdUseCases;
use App\Api\Validation;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use Exception;

class PatchController extends BaseController
{
    use Validation, ExceptionApi, ControllersTrait, PatchDTOs;

    private array $operations;

    public function __construct()
    {
        $this->operations = [
            "products_id" => new ProductsIdUseCases()
        ];
    }

    public function handle(int $chargeId = 0)
    {
        try {
            $payload = (array) $this->request->getVar();

            $operation = $payload['operation'];
            $validation = \Config\Services::validation();

            $data = $payload['data'];
            $data->id = $chargeId;

            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            if (!isset($this->operations[$operation]))
                throw new Exceptions(lang("Errors.not_found"), \NOT_FOUND);

            $responsePatch = $this->operations[$operation]->execute((array)$data);

            return $this->response->setJSON($responsePatch)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
