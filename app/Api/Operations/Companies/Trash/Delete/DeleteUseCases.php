<?php

namespace App\Api\Operations\Companies\Trash\Delete;

use App\Business\Companies\CompaniesBusiness;
use App\Database\Models\Companies\CompaniesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;
use CodeIgniter\HTTP\Response;

class DeleteUseCases
{
    const REFERENCES_CLASS = [
    ];

    /**
     * @param array{
     *   id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $companiesBusiness = new CompaniesBusiness();

        $companyId = $payload['id'];

        if (!$companiesBusiness->has([
            "id" => $companyId
        ]))
            throw new Exceptions("Api.companies.invalid.not_found", Response::HTTP_NOT_ACCEPTABLE);

        $companiesModel = new CompaniesModel();

        foreach (SELF::REFERENCES_CLASS as $instances) {
            $model = new $instances();

            $model->where("company_id", $companyId)->delete();
        }

        $companiesModel->withDeleted()->delete($companyId, true);

        NotificationsService::store([
            "scope" => "companies",
            "action" => "DELETE"
        ]);
        return (object)[
            "success" => "Api.companies.trash.success.delete"
        ];
    }
}
