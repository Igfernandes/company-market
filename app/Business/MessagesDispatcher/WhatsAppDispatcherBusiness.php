<?php

namespace App\Business\MessagesDispatcher;

use App\Database\Entities\MessagesDispatcher\MessageDispatcherEntity;
use App\Services\WhatsApp\WhatsAppService;

class WhatsAppDispatcherBusiness
{
    /**
     * @param MessageDispatcherEntity $messageDispatcherEntity
     * @param array{int} $clientsId 
     */
    public function execute(MessageDispatcherEntity $messageDispatcherEntity, array $clientsId)
    {
        $whatsAppService = new WhatsAppService();

        $whatsAppService->notification($clientsId, $messageDispatcherEntity->getId());
    }
}
