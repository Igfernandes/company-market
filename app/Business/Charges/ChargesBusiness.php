<?php

namespace App\Business\Charges;

use App\Business\BaseBusiness;
use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Models\Finances\ChargesModel;
use App\Helpers\Validates\Date;
use App\Services\CronJob\CronJobService;
use App\Services\CronJob\Entities\Job;
use App\Services\CronJob\Entities\Schedule;
use DateInterval;
use DateTime;
use DateTimeZone;

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

    public function isNotChargeExpired(ChargeEntity $charge): bool
    {
        if (empty($charge->getExpiredDays())) return true;

        if (empty($charge->getStartedAt()))
            $chargeDate = new Datetime($charge->getCreatedAt());
        else {
            $chargeDate = new Datetime($charge->getStartedAt());
        }

        $expiredDate = clone $chargeDate;
        $expiredDays = $charge->getExpiredDays();
        $expiredDate->add(new DateInterval("P{$expiredDays}D"));

        if ($expiredDate->format("dHi") < $chargeDate->format('dHi'))
            return true;

        return false;
    }

    public function getAvailableCharge(?array $query = [], int $amountCurrent = 1): array|false
    {
        /** @var array{ChargeEntity} */
        $founds = $this->chargesModel->select("charges.*")->join("payments", "payments.charge_id = charges.id", "left")
            ->where($query)->findAll();

        if (!isset($founds[0])) return false;

        $amounts = 1;
        $charge = $founds[0];
        if (empty($charge->getAmount())) {
            $amountBusy = count($founds) + $amountCurrent;
            $amounts = $charge->getAmount() - $amountBusy;
            $isAmountAvailableCharges = count($founds) > $amounts;
        } else {
            $isAmountAvailableCharges = true;
        }

        if (!$this->isNotChargeExpired($charge) || !$isAmountAvailableCharges)
            return false;

        return [
            "charge" => $founds[0],
            "amountAvailable" => $amounts
        ];
    }
}
