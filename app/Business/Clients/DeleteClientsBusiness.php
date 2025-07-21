<?php

namespace App\Business\Clients;

use App\Database\Models\Clients\ClientsCategoriesModel;
use App\Database\Models\Clients\ClientsModel;
use App\Database\Models\CustomForms\ClientsFormsHistoryModel;
use App\Database\Models\Fields\ClientsFieldsModel;
use App\Database\Models\Services\ClientsServicesModel;

class DeleteClientsBusiness
{
    private ClientsModel $clientsModel;
    private ClientsCategoriesModel $clientCategoriesModel;
    private ClientsFieldsModel $clientsFieldsModel;
    private ClientsFormsHistoryModel $clientsFormsHistory;
    private ClientsServicesModel $clientsServices;

    public function __construct()
    {
        $this->clientsModel = new ClientsModel();
        $this->clientCategoriesModel = new ClientsCategoriesModel();
        $this->clientsFieldsModel = new ClientsFieldsModel();
        $this->clientsFormsHistory = new ClientsFormsHistoryModel();
        $this->clientsServices = new ClientsServicesModel();
    }

    /**
     * @param array{client_id:string} $payload
     */
    public function deleteSingleClient(array $payload)
    {
        $this->clientCategoriesModel->where($payload)->delete();
        $this->clientsFieldsModel->where($payload)->delete();
        $this->clientsFormsHistory->whereIn($payload)->delete();
        $this->clientsServices->whereIn($payload)->delete();
        $this->clientsModel->where("id", $payload['client_id'])->delete();
    }

    public function deleteMultipleClients($clientsId)
    {
        $this->clientCategoriesModel->whereIn("client_id", $clientsId)->delete();
        $this->clientsFieldsModel->whereIn("client_id", $clientsId)->delete();
        $this->clientsFormsHistory->whereIn("client_id", $clientsId)->delete();
        $this->clientsServices->whereIn("client_id", $clientsId)->delete();
        $this->clientsModel->whereIn("id", $clientsId)->delete();
    }
}
