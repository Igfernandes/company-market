<?php

namespace App\Api\CustomForms\Post;

use App\Database\Entities\CustomForms\CustomFormEntity;
use App\Database\Models\CustomForms\CustomFormsModel;
use App\Services\Notifications\NotificationsService;
use App\Traits\BusinessTrait;
use App\Traits\CustomForms\CustomFormsDataTrait;

class PostUseCases
{
    use CustomFormsDataTrait, BusinessTrait;

    /**
     * @param array{
     *     name: string, 
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

        if (isset($filteredPayload['service_id']))
            $customFormEntity->setServiceId($filteredPayload['service_id']);

        if (isset($filteredPayload['started_at']))
            $customFormEntity->setStartedAt($filteredPayload['started_at']);

        $customFormEntity->setColorMark($filteredPayload['color_mark']);
        if (isset($filteredPayload['thanks_message']))
            $customFormEntity->setThanksMessage($filteredPayload['thanks_message']);

        if (isset($filteredPayload['expired_at']))
            $customFormEntity->setExpiredAt($filteredPayload['expired_at']);

        $customFormEntity->setStatus($filteredPayload['status']);
        $customFormEntity->setComponents($filteredPayload['components']);
        $customFormEntity->setSlug("form_" . date("his"));

        $customFormsModel->save($customFormEntity);

        NotificationsService::store([
            "scope" => "forms",
            "action" => "CREATE",
            "key" =>  $customFormsModel->getInsertID()
        ]);
        return (object)[
            "success" => "Api.custom_forms.success.post"
        ];
    }
}
