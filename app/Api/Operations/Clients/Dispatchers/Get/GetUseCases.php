<?php

namespace App\Api\Operations\Clients\Dispatchers\Get;

use App\Database\Entities\MessagesDispatcher\ClientMessageDispatcherEntity;
use App\Database\Models\MessagesDispatcher\ClientsMessagesDispatcherModel;
use App\Traits\BusinessTrait;
use App\Traits\MessagesDispatcher\ClientsMessagesDataTrait;

class GetUseCases
{
    use ClientsMessagesDataTrait, BusinessTrait;

    /**
     * @param array{
     *  id: int|null,
     *  client_id: integer|null,
     *  message_id: integer|null,
     *  status: "ACTIVE"|"INACTIVE"|null
     * } $payload
     */
    public function execute(array $payload)
    {
        $clientsMessagesDispatcherModel = new ClientsMessagesDispatcherModel();

        $clientQuery = !empty($payload['client_id']) ? ["id" => $payload['client_id']] : [];
        $messageQuery = !empty($payload['message_id']) ? ["id" => $payload['message_id']] : [];

        /** @var array{ClientMessageDispatcherEntity} */
        $foundClientsMessage = $clientsMessagesDispatcherModel->getClientsWithMessages($clientQuery, $messageQuery);

        $clientsMessageData = [];
        foreach($foundClientsMessage as $clientMessage){
            if(!empty($payload['id']) && $clientMessage->getId() == $payload['id'])
                return $this->MessageWithClients($clientMessage);

            if(!empty($payload['status']) && $payload['status'] != $payload['status'])
                continue;

            \array_push($clientsMessageData, $this->MessageWithClients($clientMessage));
        }
   
        return \array_values($clientsMessageData);
    }
}
