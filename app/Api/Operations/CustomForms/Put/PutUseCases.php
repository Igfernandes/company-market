<?php

namespace App\Api\Operations\CustomForms\Put;

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
     *     status: 'PUBLISHED'|'DRAFT',
     *     status: string,
     *     type: 'PEOPLE'|'COMPANY', 
     *     description: string, 
     *     components: string,
     *     status: 'PUBLISHED' | 'DRAFT',
     *     color_mark: string,
     *     thanks_message: string,
     *     service_id: int,
     *     started_at: string,
     *     expired_at: string
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

        if (isset($filteredPayload['service_id']))
            $customFormEntity->setServiceId($filteredPayload['service_id']);

        if (isset($filteredPayload['started_at']))
            $customFormEntity->setStartedAt($filteredPayload['started_at']);

        if (isset($filteredPayload['expired_at']))
            $customFormEntity->setExpiredAt($filteredPayload['expired_at']);

        if (isset($filteredPayload['thanks_message']))
            $customFormEntity->setThanksMessage($filteredPayload['thanks_message']);

        if (isset($filteredPayload['color_mark']))
            $customFormEntity->setColorMark($filteredPayload['color_mark']);

        $customFormEntity->setStatus($filteredPayload['status']);
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
