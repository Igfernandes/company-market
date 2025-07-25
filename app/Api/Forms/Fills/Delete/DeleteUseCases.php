<?php

namespace App\Api\Forms\Fills\Delete;

use App\Database\Models\CustomForms\ClientsFormsHistoryModel;
use App\Database\Models\CustomForms\FormFillsModel;
use App\Traits\BusinessTrait;
use App\Traits\CustomForms\CustomFormsDataTrait;

class DeleteUseCases
{
    use CustomFormsDataTrait, BusinessTrait;
    /**
     * @param array{
     *     form_id: number,
     *     package: string 
     * } $payload
     */
    public function execute(array $payload)
    {
        $formsFillsModel = new FormFillsModel();
        $clientsFormsHistoryModel = new ClientsFormsHistoryModel();

        $formsFillsModel->where($payload)->delete();
        $clientsFormsHistoryModel->where($payload)->delete();
        
        return (object)[
            "success" => "Api.custom_forms.fills.success.delete"
        ];
    }
}
