<?php

namespace App\Api\Finances\Charges\Delete;

use App\Business\Charges\DeleteChargesBusiness;
use App\Database\Models\Reports\OperationFailuresModel;

class DeleteUseCases
{
    /**
     * @param array{charge_id:string,in_charges:array{integer}} $payload
     */
    public function execute(array $payload)
    {
        $deleteClientBusiness = new DeleteChargesBusiness();

        if (isset($payload['charge_id']))
            $deleteClientBusiness->deleteSingleCharge($payload);
        else if (isset($payload['in_charges']))
            $deleteClientBusiness->deleteMultipleCharges($payload['in_charges']);

        return (object)[
            "success" => lang("Api.charges.success.delete")
        ];
    }
}
