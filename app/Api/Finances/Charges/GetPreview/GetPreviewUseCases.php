<?php

namespace App\Api\Finances\Charges\GetPreview;

use App\Business\Charges\ChargesBusiness;
use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Entities\Services\ServiceEntity;
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
        $chargesBusiness = new ChargesBusiness();

        $filteredPayload['charges.status'] = "ACTIVE";

        /** @var ChargeEntity */
        $response =  $chargesBusiness->getAvailableCharge($filteredPayload);

        if ($response === false) return null;
        $charge = $response['charge'];

        $data = [
            "title" => $charge->getTitle(),
            "description" => $charge->getDescription(),
            "price" => $charge->getPrice(),
            "promotional_price" => $charge->getPromotionalPrice(),
            "amount"        =>  $response['amountAvailable'],
            "type" => $charge->getType()
        ];

        if (!empty($charge->getServiceId())) {
            $servicesModel = new ServicesModel();

            /** @var ServiceEntity */
            $foundService = $servicesModel->where("id", $charge->getServiceId())->first();

            if (!empty($foundService))
                $data['service'] = [
                    "name" => $foundService->getName(),
                    "description" => $foundService->getDescription(),
                    "photo" => $foundService->getPhoto()
                ];
        }

        return $data;
    }
}
