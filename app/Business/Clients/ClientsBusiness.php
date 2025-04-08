<?php


namespace App\Business\Clients;

use App\Business\BaseBusiness;
use App\Database\Models\Clients\ClientsModel;

class ClientsBusiness
{
    use BaseBusiness;

    public function hasClient(int $clientId): bool
    {
        $clientsModel = new ClientsModel();

        $foundClient = $clientsModel->where("id", $clientId)->first();

        return !empty($foundClient);
    }
}
