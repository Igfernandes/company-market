<?php

namespace App\Api\MessagesDispatcher\Delete;

use App\Business\MessagesDispatcher\MessagesDispatcherBusiness;
use App\Business\MessagesDispatcher\ScheduleDispatcherBusiness;
use App\Database\Entities\MessagesDispatcher\MessageDispatcherEntity;
use App\Database\Models\MessagesDispatcher\ClientsMessagesDispatcherModel;
use App\Database\Models\MessagesDispatcher\MessagesDispatcherModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;

class DeleteUseCases
{
    /**
     * @param array{
     *   id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $messagesDispatcherBusiness = new MessagesDispatcherBusiness();

        $messageDispatcher = new MessageDispatcherEntity();
        $messageDispatcher->setId($payload['id']);

        if (!$messagesDispatcherBusiness->hasMessageDispatcher([
            "id" => $messageDispatcher->getId()
        ]))
            throw new Exceptions(\str_replace("{field}", lang("Words.notification"), lang("Validation.not_found")), \BAD_BUSINESS_RULES);

        $messageDispatcherModel = new MessagesDispatcherModel();
        $scheduleDispatcherBusiness = new ScheduleDispatcherBusiness();
        $clientsMessagesModel = new ClientsMessagesDispatcherModel();

        $clientsMessagesModel->where("message_id", $payload['id'])->delete();
        $scheduleDispatcherBusiness->delete($messageDispatcher);
        $messageDispatcherModel->delete($messageDispatcher->toArray(true));

        NotificationsService::store([
            "scope" => "dispatcher",
            "action" => "DELETE"
        ]);
        return (object)[
            "success" => "Api.dispatcher.success.delete"
        ];
    }
}
