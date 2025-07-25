<?php

namespace App\Api\CustomForms\Get;

use App\Database\Entities\CustomForms\CustomFormEntity;
use App\Database\Models\CustomForms\CustomFormsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\CustomForms\CustomFormsDataTrait;

class GetUseCases
{
    use CustomFormsDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     name: string, 
     *     name_contains: string,
     *     slug: string,
     *     slug_contains: string,
     *     type: 'PEOPLE'|'COMPANY', 
     *     description_contains: string, 
     *     status: 'ACTIVE' | 'INACTIVE', 
     *     service_id: int,
     *     started_at: string,
     *     expired_at: string,
     *     created_at: string, 
     *     updated_at: string 
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $customFormModel = new CustomFormsModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        if (count($in_ids) > 0)
            $customFormModel->whereIn("id", $in_ids);

        $customFormModel = $this->builderClauseWithContains($payload, $customFormModel);

        $customForm = $customFormModel->where($filteredPayload)->findAll();

        if (!empty($payload['id']) && count($customForm) > 0)
            return $this->builder($customForm[0]);
        else if (!empty($payload['id']) && \count($customForm) == 0)
            throw new Exceptions("Api.fields.invalid.not_found", \NOT_FOUND);

        $customFormData = array_map(
            fn(CustomFormEntity $formsCustom) => $this->builder($formsCustom),
            $customForm
        );

        return \array_values($customFormData);
    }
}
