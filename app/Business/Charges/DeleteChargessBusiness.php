<?php

namespace App\Business\Charges;

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
        $this->chargesClientsModel->where($payload)->delete();
        $this->chargesModel->where("id", $payload['charge_id'])->delete();
    }

    public function deleteMultipleCharges($chargesId)
    {
        $this->chargesClientsModel->whereIn("charge_id", $chargesId)->delete();
        $this->chargesModel->whereIn("id", $chargesId)->delete();
    }
}
