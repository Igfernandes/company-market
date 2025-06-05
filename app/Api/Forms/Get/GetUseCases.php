<?php

namespace App\Api\Forms\Get;

use App\Database\Models\CustomForms\CustomFormsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\CustomForms\CustomFormsDataTrait;

class GetUseCases
{
    use CustomFormsDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $customFormModel = new CustomFormsModel();

        $customForm = $customFormModel->where($filteredPayload)->first();

        if (empty($customForm))
            throw new Exceptions(lang("Errors.not_found"), \NOT_FOUND);

        return $customForm;
    }
}
