<?php

namespace App\Api\Operations\Companies\Delete;

use App\Database\Models\Companies\CompaniesModel;
use App\Services\Notifications\NotificationsService;

class DeleteUseCases
{
    /**
     * @param array{company_id:string,in_companies:array{integer}} $payload
     */
    public function execute(array $payload)
    {
        $companiesModel = new CompaniesModel();

        if (isset($payload['in_companies']) && is_array($payload['in_companies'])) {
            $companiesModel->whereIn("id", $payload['in_companies'])->delete();
        } else if (!empty($payload['company_id'])) {
            $companiesModel->where("id", $payload['company_id'])->delete();
        }

        NotificationsService::store([
            "scope" => "companies",
            "action" => "DELETE"
        ]);
        return [
            "success" => "Api.companies.success.delete"
        ];
    }
}
