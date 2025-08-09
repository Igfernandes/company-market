<?php

namespace App\Api\Operations\CustomForms\Delete;

use App\Database\Models\CustomForms\ClientsFormsHistoryModel;
use App\Database\Models\CustomForms\CustomFormsModel;
use App\Database\Models\CustomForms\FormFillsModel;
use App\Services\Notifications\NotificationsService;
use App\Traits\BusinessTrait;
use App\Traits\CustomForms\CustomFormsDataTrait;

class DeleteUseCases
{
    use CustomFormsDataTrait, BusinessTrait;
    /**
     * @param array{
     *     id: number, 
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $customFormsModel = new CustomFormsModel();
        $formsFillsModel = new FormFillsModel();
        $clientFormHistoryModel = new ClientsFormsHistoryModel();

        $formsFillsModel->where("form_id", $filteredPayload['id'])->delete();
        $clientFormHistoryModel->where("form_id", $filteredPayload['id'])->delete();
        $customFormsModel->delete($filteredPayload['id']);
        $customFormsModel->delete($filteredPayload['id']);

        NotificationsService::store([
            "scope" => "forms",
            "action" => "DELETE"
        ]);
        return (object)[
            "success" => "Api.custom_forms.success.delete"
        ];
    }
}
