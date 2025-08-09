<?php

namespace App\Api\Operations\Clients\Delete;

use App\Business\Clients\DeleteClientsBusiness;
use App\Services\Notifications\NotificationsService;

class DeleteUseCases
{
    /**
     * @param array{client_id:string,in_clients:array{integer}} $payload
     */
    public function execute(array $payload)
    {
        $deleteClientBusiness = new DeleteClientsBusiness();
        
        if (is_array($payload['in_clients'])) {
            $deleteClientBusiness->deleteMultipleClients($payload['in_clients']);
        } else if (!empty($payload['client_id'])) {
            unset($payload['in_clients']);
            $deleteClientBusiness->deleteSingleClient($payload);
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
