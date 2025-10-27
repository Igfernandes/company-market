<?php

namespace App\Api\Operations\Companies\Get;

use App\Database\Entities\Companies\CompanyEntity;
use App\Database\Models\Companies\CompaniesModel;
use App\Traits\BusinessTrait;
use App\Traits\Companies\CompaniesDataTrait;

class GetUseCases
{
    use CompaniesDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     name: string, 
     *     phone: string, 
     *     inscribed_at: string, 
     *     status: 'ACTIVE' | 'INACTIVE', 
     *     created_at: string, 
     *     updated_at: string,
     *     limit: integer|undefined,
     *     start: integer|undefined
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = array_filter($payload, fn($field) => !empty($field));

        $companiesModel = new CompaniesModel();

        $companyEntity = new CompanyEntity();
        $companyEntity->store($payload);

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        if (isset($filteredPayload['phone'])) {
            $filteredPayload['phone_sha256'] = referenceHash($filteredPayload['phone']);
            unset($filteredPayload['phone']);
        }

        $companiesModel->where($companyEntity->toArray(true));
        if (count($in_ids) > 0)
            $companiesModel->whereIn("id", $in_ids);

        $companiesModel = $this->builderClauseWithContains($filteredPayload, $companiesModel);

        $limit = isset($payload['limit']) ? \intval($payload['limit']) : 50;
        $startIndexRegister = isset($payload['start']) ? \intval($payload['start']) : 0;

        $found = $companiesModel->limit($limit, $startIndexRegister)->findAll();

        return array_map(
            fn(CompanyEntity $company) => $this->data($company),
            $found
        );
    }
}
