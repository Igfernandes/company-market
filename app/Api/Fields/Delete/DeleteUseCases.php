<?php

namespace App\Api\Fields\Delete;

use App\Business\Fields\FieldsBusiness;
use App\Business\Users\UsersBusiness;
use App\Database\Models\Fields\ClientsFieldsModel;
use App\Database\Models\Fields\FieldsModel;
use App\Database\Models\Fields\UsersFieldsModel;
use App\Database\Models\Users\UsersGroupsModel;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Exceptions\Exceptions;

class DeleteUseCases
{
    /**
     * @param array{
     *   id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $fieldsBusiness = new FieldsBusiness();

        $fieldId = $payload['id'];

        if (!$fieldsBusiness->hasField([
            "id" => $fieldId
        ]))
            throw new Exceptions(\str_replace("{field}", lang("Words.field"), lang("Validation.not_found")), \BAD_BUSINESS_RULES);

        $usersModel = new FieldsModel();
        $usersFieldsModel = new UsersFieldsModel();
        $clientsFieldsModel = new ClientsFieldsModel();
        $queryString = "field_id = $fieldId";

        $clientsFieldsModel->where($queryString)->delete();
        $usersFieldsModel->where($queryString)->delete();
        $usersModel->delete($fieldId);

        return (object)[
            "success" => lang("Api.fields.success.delete")
        ];
    }
}
