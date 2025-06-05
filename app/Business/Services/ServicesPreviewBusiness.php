<?php

namespace App\Business\Services;

use App\Business\BaseBusiness;
use App\Business\Charges\ChargesBusiness;
use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Entities\Services\ServiceEntity;
use App\Database\Models\Finances\ChargesModel;
use App\Database\Models\Services\ServicesModel;

class ServicesPreviewBusiness
{
    use BaseBusiness;

    private ServicesModel $servicesModel;
    private ChargesModel $chargesModel;

    public function __construct()
    {
        $this->servicesModel = new ServicesModel();
        $this->chargesModel = new ChargesModel();
    }

    public function getServiceWithCharge($query): array|null
    {
        /** @var ChargeEntity */
        $charge = $this->chargesModel->where([
            "reference" => $query['charge']
        ])->first();

        if (empty($charge)) return null;

        /** @var ServiceEntity */
        $service = $this->servicesModel->where([
            "id" => $charge->getServiceId()
        ])->first();

        if (empty($service)) return null;

        $chargesBusiness = new ChargesBusiness();

        return [
            "name" => $service->getName(),
            "description" => $service->getDescription(),
            "photo" => getPublicUrl($service->getPhoto()),
            "realized_at" => $service->getRealizedAt(),
            "expired_at" => $service->getExpiredAt(),
            "address" => $service->getAddress(),
            "charge" => [
                "price" => $charge->getPrice(),
                "promotional_price" => $charge->getPromotionalPrice(),
                "amount" => $charge->getAmount(),
                "reference" => $query['charge'],
                "title" => $charge->getTitle(),
                "sold_out" => $chargesBusiness->getAvailableCharge([
                    "reference" => $charge->getReference()
                ]) == false
            ]
        ];
    }

    public function getServiceWithForm($query): array|null
    {
        $service = $this->servicesModel->where($query)->first();

        return  [
            "name" => $service->getName(),
            "description" => $service->getDescription(),
            "photo" => getPublicUrl($service->getPhoto()),
            "realized_at" => $service->getRealizedAt(),
            "expired_at" => $service->getExpiredAt(),
            "address" => $service->getAddress(),
        ];
    }
}
