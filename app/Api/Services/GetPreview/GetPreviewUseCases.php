<?php

namespace App\Api\Services\GetPreview;

use App\Business\Charges\ChargesBusiness;
use App\Business\Services\ServicesPreviewBusiness;
use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Entities\Services\ServiceEntity;
use App\Database\Models\Finances\ChargesModel;
use App\Database\Models\Services\ServicesModel;
use App\Traits\BusinessTrait;
use App\Traits\Charges\ChargesDataTrait;

class GetPreviewUseCases
{
    use ChargesDataTrait, BusinessTrait;

    /**
     * @param array{
     *     charge: string,
     *     in_forms: string, 
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));
        $servicesPreviewBusiness = new ServicesPreviewBusiness();

        if (isset($payload['charge']))
            return $servicesPreviewBusiness->getServiceWithCharge($filteredPayload);
        else return $servicesPreviewBusiness->getServiceWithForm($filteredPayload);
    }
}
