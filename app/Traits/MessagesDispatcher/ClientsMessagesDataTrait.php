<?php

namespace App\Traits\MessagesDispatcher;

use App\Database\Entities\MessagesDispatcher\ClientMessageDispatcherEntity;

trait ClientsMessagesDataTrait
{
    public function MessageWithClients(ClientMessageDispatcherEntity $clientsMessages): Object
    {
        return  (object)[
            "client_id"       => $clientsMessages->getClientId(),
            "client_name"     => $clientsMessages->getClient()->getName(),
            "platform"        => $clientsMessages->getPlatform(),
            "status"          => $clientsMessages->getStatus(),
            "log"             => $clientsMessages->getLogError(),
            "message_id"      => $clientsMessages->getMessageId(),
            "message_title"   => $clientsMessages->getMessage()->getTitle(),
            "created_at"      => $clientsMessages->getCreatedAt()
        ];
    }
}
