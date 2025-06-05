<?php

namespace App\Services\WhatsApp\Operations;

use App\Database\Entities\MessagesDispatcher\ClientMessageDispatcherEntity;
use App\Database\Models\MessagesDispatcher\ClientsMessagesDispatcherModel;

class Store
{
    public static function execute(array $clientsFeedback, int $messageId)
    {
        $clientsMessagesDispatcherModel = new ClientsMessagesDispatcherModel();

        foreach ($clientsFeedback as $status => $metaResponse) {
            $clientMessageEntity = new ClientMessageDispatcherEntity();

            $clientMessageEntity->setMessageId($messageId);
            $clientMessageEntity->setPlatform("WHATSAPP");
            $clientMessageEntity->setStatus("PENDING");

            if ($status !== OK)
                $clientMessageEntity->setLogError($metaResponse[0]['response']);

            $clientRegisters = array_map(function ($response) use ($clientMessageEntity) {
                $clientMessageEntity->setClientId($response['client_id']);

                return $clientMessageEntity->toArray(true);
            }, $metaResponse);

            $clientsMessagesDispatcherModel->insertBatch($clientRegisters);
        }
    }
}
