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
        $now = date("Y-m-d H:i:s");

        $customForm = $customFormModel->groupStart()
            ->where('started_at <=', $now)
            ->orWhere('started_at IS NULL')
            ->groupEnd()
            ->groupStart()
            ->where('expired_at >', $now)
            ->orWhere('expired_at IS NULL')
            ->groupEnd()->where([
                "status" => "PUBLISHED"
            ])->where($filteredPayload)->first();

        if (empty($customForm))
            throw new Exceptions("Api.forms.invalid.not_found", \NOT_FOUND);

        return $customForm->toArray();
    }
}
