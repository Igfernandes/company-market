<?php

namespace App\Api\Webhooks\Tasks\Dispatcher\Post;

use App\Business\MessagesDispatcher\MessagesDispatcherBusiness;
use App\Business\MessagesDispatcher\ScheduleDispatcherBusiness;
use App\Database\Entities\MessagesDispatcher\ClientMessageDispatcherEntity;
use App\Database\Models\MessagesDispatcher\ClientsMessagesDispatcherModel;
use App\Database\Models\MessagesDispatcher\MessagesDispatcherModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;

class PostUseCases
{
    /**
     * @param array{
     *   k: string
     */
    public function execute(array $payload)
    {
        $messageDispatcher = new MessagesDispatcherModel();

        $dispatcher  = $messageDispatcher->where([
            "reference" => $payload['k'],
            "status" => "ACTIVE"
        ])->first();

        if (empty($dispatcher))
            throw new Exceptions("Api.tasks.dispatcher.not_found", \NOT_FOUND);

        $clientsMessagesModel = new ClientsMessagesDispatcherModel();

        $clientsMessages = $clientsMessagesModel->where("message_id", $dispatcher->getId())->findAll();
        $clientsId = \array_map(fn(ClientMessageDispatcherEntity $clientMessage) => $clientMessage->getClientId(), $clientsMessages);

        $messagesDispatcherBusiness = new MessagesDispatcherBusiness();

        $messagesDispatcherBusiness->send($clientsId, $dispatcher);
        ScheduleDispatcherBusiness::scheduleDispatcherClients($clientsId, $dispatcher);

        NotificationsService::store([
            "scope" => "dispatchers",
            "action" => "UPDATE",
            "Key" => $dispatcher->getId()
        ]);
        return (object)[
            "success" => "Api.tasks.dispatcher.success"
        ];
    }
}
