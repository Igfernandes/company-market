<?php

namespace App\Services\Mailer\Operations;

use App\Database\Entities\MessagesDispatcher\ClientMessageDispatcherEntity;
use App\Database\Models\MessagesDispatcher\ClientsMessagesDispatcherModel;

class Store
{
    public static function execute(array $clientIds, int $messageId)
    {
        $clientsMessagesDispatcherModel = new ClientsMessagesDispatcherModel();
        $clientRegisters = [];

        foreach ($clientIds as $clientId) {
            $clientMessageEntity = new ClientMessageDispatcherEntity();

            $clientMessageEntity->setMessageId($messageId);
            $clientMessageEntity->setPlatform("EMAIL");
            $clientMessageEntity->setStatus("SUCCESSFUL");

            $clientMessageEntity->setClientId($clientId);

            array_push($clientRegisters, $clientMessageEntity->toArray(true));
        }

        $clientsMessagesDispatcherModel->insertBatch($clientRegisters);
    }
}
