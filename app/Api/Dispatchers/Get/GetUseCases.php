<?php

namespace App\Api\Dispatchers\Get;

use App\Database\Entities\MessagesDispatcher\MessageDispatcherEntity;
use App\Database\Models\MessagesDispatcher\ClientsMessagesDispatcherModel;
use App\Database\Models\MessagesDispatcher\MessagesDispatcherModel;
use App\Traits\BusinessTrait;

class GetUseCases
{
    use BusinessTrait;

    /**
     * @param array{ 
     *     id: int,
     *     in_ids: array<int>, 
     *     title: string,
     *     weekday: 'SUNDAY'| 'MONDAY'| 'TUESDAY'| 'WEDNESDAY'| 'THURSDAY'| 'FRIDAY'| 'SATURDAY',
     *     period:  'DAILY' | 'WEEKLY' | 'MONTHLY',
     *     content: string,
     *     platforms: array{'FACEBOOK' | 'INSTAGRAM' | 'WHATSAPP' | 'EMAIL' | 'SMS'},
     *     scheduled_at: string,
     *     started_at: string, 
     *     service_id: integer, 
     *     charge_id: integer, 
     *     clients: array{integer}
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $messagesDispatcherModel = new MessagesDispatcherModel();
        $messageDispatcherEntity = new MessageDispatcherEntity();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        $messagesDispatcherModel = $this->builderClauseWithContains($filteredPayload ?? [], $messagesDispatcherModel);

        if (count($in_ids) > 0)
            $messagesDispatcherModel->whereIn("id", $in_ids);

        $messageDispatcherEntity->store($filteredPayload);
        /** @var array{MessageDispatcherEntity}*/
        $found = $messagesDispatcherModel->select("messages_dispatcher.*, users.name")->join("users", "users.id = messages_dispatcher.author_id")
            ->where($messageDispatcherEntity->toArray())->findAll();
        $clientsMessagesDispatcherModel = new ClientsMessagesDispatcherModel();

        if (\count($found) == 0)
            return [];

        $foundClientsMessage = $clientsMessagesDispatcherModel
            ->whereIn(
                "message_id",
                \array_map(fn(MessageDispatcherEntity $message) => $message->getId(), $found)
            )->findAll();

        $clientsIdsAlreadyCountable = [];
        return array_map(function (MessageDispatcherEntity $dispatcher) use ($foundClientsMessage, $clientsIdsAlreadyCountable) {
            $dispatcherData = $dispatcher->toArray();
            $dispatcherData['author'] = $dispatcher->attributes['name'];
            $dispatcherId = $dispatcher->getId();

            $clientsIdsAlreadyCountable[$dispatcherId] = [];
            $dispatcherData['linked'] = 0;
            foreach ($foundClientsMessage as $clientDispatcher) {
                if (
                    $dispatcher->getId() == $clientDispatcher->getMessageId()
                    && !in_array($clientDispatcher->getClientId(), $clientsIdsAlreadyCountable[$dispatcher->getId()])
                ) {
                    array_push($clientsIdsAlreadyCountable[$dispatcher->getId()], $clientDispatcher->getClientId());

                    $dispatcherData['linked'] += 1;
                }
            }

            return $dispatcherData;
        }, $found);
    }
}
