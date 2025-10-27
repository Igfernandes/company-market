<?php

namespace App\Api\Operations\Clients\Delete;

use App\Database\Models\Clients\ClientsModel;
use App\Services\Notifications\NotificationsService;

class DeleteUseCases
{
    /**
     * @param array{client_id:string,in_clients:array{integer}} $payload
     */
    public function execute(array $payload)
    {
        $clientsModel = new ClientsModel();

        if (isset($payload['in_clients']) && is_array($payload['in_clients'])) {
            $clientsModel->whereIn("id", $payload['in_clients'])->delete();
        } else if (!empty($payload['client_id'])) {
            $clientsModel->where("id", $payload['client_id'])->delete();
        }

        NotificationsService::store([
            "scope" => "clients",
            "action" => "DELETE"
        ]);
        return [
            "success" => "Api.clients.success.delete"
        ];
    }
}
