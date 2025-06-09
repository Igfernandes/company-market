<?php

namespace App\Business\Charges;

use App\Business\Charges\ChargeScheduleBusiness;
use App\Database\Models\Finances\ChargesModel;
use App\Database\Models\Finances\ChargesClientsModel;

class DeleteChargesBusiness
{
    private ChargesModel $chargesModel;
    private ChargesClientsModel $chargesClientsModel;

    public function __construct()
    {
        $this->chargesModel = new ChargesModel();
        $this->chargesClientsModel = new ChargesClientsModel();
    }

    /**
     * @param array{charge_id:string} $payload
     */
    public function deleteSingleCharge(array $payload)
    {
        $charge = $this->chargesModel->where("id", $payload['charge_id'])->first();

        $this->chargesClientsModel->where("charge_id", $payload['charge_id'])->delete();
        $this->chargesModel->where("id", $payload['charge_id'])->delete();

        if (!empty($charge))
            ChargeScheduleBusiness::delete($charge);
    }

    public function deleteMultipleCharges($chargesId)
    {
        $charges = $this->chargesModel->whereIn("id", $chargesId)->findAll();

        $this->chargesClientsModel->whereIn("charge_id", $chargesId)->delete();
        $this->chargesModel->whereIn("id", $chargesId)->delete();

        foreach ($charges as $charge) {
            ChargeScheduleBusiness::delete($charge);
        }
    }
}
