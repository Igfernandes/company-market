<?php

namespace App\Business\Charges;

use App\Business\BaseBusiness;
use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Models\Finances\ChargesModel;

class ChargesBusiness
{
    use BaseBusiness;
    private ChargesModel $chargesModel;

    public function __construct()
    {
        $this->chargesModel = new ChargesModel();
    }

    public function hasCharge($query): bool
    {
        $founds = $this->chargesModel->where($query)->first();

        return !empty($founds);
    }


    public function getAvailableCharge(?array $query = [], int $amountCurrent = 1): array|false
    {

        /** @var array{ChargeEntity} */
        $founds = $this->chargesModel->select("charges.*")->join("payments", "payments.charge_id = charges.id", "left")
            ->where($query)->findAll();

        if (!isset($founds[0])) return false;

        $charge = $founds[0];
        $amountBusy = count($founds) + $amountCurrent;
        $amounts = $charge->getAmount() - $amountBusy;

        $isNotExpiredCharge = empty($charge->getExpiredAt()) || strtotime($charge->getExpiredAt()) > strtotime(date("Y-m-d"));

        if (!$isNotExpiredCharge || count($founds) > $amounts)
            return false;

        return [
            "charge" => $founds[0],
            "amountAvailable" => $amounts
        ];
    }
}
