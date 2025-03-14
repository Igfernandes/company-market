<?php

namespace App\Business\Clients;

use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use App\Database\Models\Fields\ClientsFieldsModel;

class DeleteClientsBusiness
{
    private ClientsModel $clientsModel;
    private ClientsCategoriesModel $clientCategoriesModel;
    private ClientsFieldsModel $clientsFieldsModel;

    public function __construct()
    {
        $this->clientsModel = new ClientsModel();
        $this->clientCategoriesModel = new ClientsCategoriesModel();
        $this->clientsFieldsModel = new ClientsFieldsModel();
    }

    /**
     * @param array{client_id:string} $payload
     */
    public function deleteSingleClient(array $payload)
    {
        $this->clientCategoriesModel->where($payload)->delete();
        $this->clientsFieldsModel->where($payload)->delete();
        $this->clientsModel->where("id", $payload['client_id'])->delete();
    }

    public function deleteMultipleClients($clientsId)
    {
        $this->clientCategoriesModel->whereIn("client_id", $clientsId)->delete();
        $this->clientsFieldsModel->whereIn("client_id", $clientsId)->delete();
        $this->clientsModel->whereIn("id", $clientsId)->delete();
    }
}
