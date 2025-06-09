<?php

namespace App\Api\Clients\Delete;

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

        if (isset($payload['client_id']))
            $deleteClientBusiness->deleteSingleClient($payload);
        else if (isset($payload['in_clients']))
            $deleteClientBusiness->deleteMultipleClients($payload['in_clients']);

        NotificationsService::store([
            "scope" => "clients",
            "action" => "DELETE"
        ]);
        return [
            "success" => "Api.clients.success.delete"
        ];
    }
}
