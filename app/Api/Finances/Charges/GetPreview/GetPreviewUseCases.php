<?php

namespace App\Api\Finances\Charges\GetPreview;

use App\Business\Charges\ChargesBusiness;
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
     *     title: string,
     *     service_id: int, 
     *     reference: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));
        $chargesModel = new ChargesModel();
        $chargesBusiness = new ChargesBusiness();

        $filteredPayload['status'] = "ACTIVE";

        /** @var ChargeEntity */
        $charge =  $chargesBusiness->getAvailableCharge($filteredPayload);

        if ($charge === false) return null;

        $data = [
            "title" => $charge->getTitle(),
            "description" => $charge->getDescription(),
            "price" => $charge->getPrice(),
            "promotional_price" => $charge->getPromotionalPrice(),
            "amount"        => $charge->getAmount(),
        ];

        if (!empty($charge->getServiceId())) {
            $servicesModel = new ServicesModel();

            /** @var ServiceEntity */
            $foundService = $servicesModel->where("id", $charge->getServiceId())->first();
            $data['service'] = [
                "name" => $foundService->getName(),
                "description" => $foundService->getDescription(),
                "photo" => $foundService->getPhoto()
            ];
        }

        return $data;
    }
}
