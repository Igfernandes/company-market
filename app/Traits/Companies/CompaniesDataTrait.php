<?php

namespace App\Traits\Companies;

use App\Database\Entities\Companies\CompanyEntity;

trait CompaniesDataTrait
{
    public function data(CompanyEntity $company): Object
    {
        $categories = [];

        return  (object)[
            "id" => $company->getId(),
            "name" => $company->getName(),
            "email" => $company->getDecryptEmail(),
            "phone" => $company->getDecryptPhone(),
            "logotype" => $company->getLogotype(),
            "inscribed_at" => $company->getInscribedAt(),
            "owner_id" => $company->getOwnerId(),
            "status" => $company->getStatus(),
            "created_at" => $company->getCreatedAt(),
            "updated_at" => $company->getUpdatedAt()
        ];
    }
}
