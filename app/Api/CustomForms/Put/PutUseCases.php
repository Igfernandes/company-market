<?php

namespace App\Api\CustomForms\Put;

use App\Database\Entities\CustomForms\CustomFormEntity;
use App\Database\Models\CustomForms\CustomFormsModel;
use App\Services\Notifications\NotificationsService;
use App\Traits\BusinessTrait;
use App\Traits\CustomForms\CustomFormsDataTrait;

class PutUseCases
{
    use CustomFormsDataTrait, BusinessTrait;

    /**
     * @param array{
     *     name: string, 
     *     type: 'PEOPLE'|'COMPANY', 
     *     description: string, 
     *     components: string,
     *     status: 'PUBLISHED' | 'DRAFT',
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $customFormsModel = new CustomFormsModel();
        $customFormEntity = new CustomFormEntity();

        $customFormEntity->setName($filteredPayload['name']);
        $customFormEntity->setStatus(isset($filteredPayload['status']) ? $filteredPayload['status'] : "ACTIVE");

        if (isset($filteredPayload['description']))
            $customFormEntity->setDescription($filteredPayload['description']);
        $customFormEntity->setComponents($filteredPayload['components']);

        $customFormsModel->set($customFormEntity->toArray(true))->update($filteredPayload['id']);

        NotificationsService::store([
            "scope" => "forms",
            "action" => "UPDATE",
            "key" => $filteredPayload['id']
        ]);
        return (object)[
            "success" => "Api.custom_forms.success.put"
        ];
    }
}
