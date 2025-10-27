<?php

namespace App\Api\Operations\Companies\Trash\Get;

use App\Database\Entities\Companies\CompanyEntity;
use App\Database\Models\Companies\CompaniesModel;
use App\Traits\Companies\CompaniesDataTrait;

class GetUseCases
{
    use CompaniesDataTrait;

    /**
     * @param array{
     *     id?: int,
     *     in_ids?: array<int>, 
     *     status?: 'AVAILABLE'|'MAINTENANCE'|'UNAVAILABLE', 
     *     phone?: string, 
     *     limit: integer|undefined;
     *     start: integer|undefined;
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredFields = \array_filter($payload, fn($field) => !empty($field));

        $companyEntity = new CompanyEntity();
        $companyEntity->store($filteredFields);

        if (isset($payload['id'])) {
            $companyEntity->setId($payload['id']);
        }

        $limit = isset($payload['limit']) ? \intval($payload['limit']) : 50;
        $startIndexRegister = isset($payload['start']) ? \intval($payload['start']) : 0;

        $companyModel = new CompaniesModel();
        $foundDeleted = $companyModel->withDeleted(true)->limit($limit, $startIndexRegister)->onlyDeleted()->findAll();

        if (\count($foundDeleted) == 0)
            return [];

        if (isset($filteredFields['id']))
            return $this->data($foundDeleted[0]);

        return array_map(fn(CompanyEntity $company) => $this->data($company), $foundDeleted);
    }
}
