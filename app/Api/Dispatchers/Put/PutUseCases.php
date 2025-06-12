<?php

namespace App\Api\Dispatchers\Put;

use App\Business\MessagesDispatcher\ScheduleDispatcherBusiness;
use App\Database\Models\MessagesDispatcher\MessagesDispatcherModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\Notifications\NotificationsService;

class PutUseCases
{
    /**
     * @param array{
     *   id: integer,
     *   clients: array{integer},
     *   status: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $messagesDispatcherModel = new MessagesDispatcherModel();

        $dispatcher = $messagesDispatcherModel->where('id', $payload['id'])->first();

        if (empty($dispatcher))
            throw new Exceptions("Api.dispatchers.invalid.not_found", \BAD_BUSINESS_RULES);

        $messagesDispatcherModel->set([
            "status" => $payload['status']
        ])->where([
            "id" => $payload['id']
        ])->update();

        if (\is_array($payload['clients']) && \count($payload['clients']) > 0) {
            ScheduleDispatcherBusiness::scheduleDispatcherClients($payload['clients'], $dispatcher);
        }

        NotificationsService::store([
            "scope" => "dispatcher",
            "action" => "UPDATE"
        ]);
        return (object)[
            "success" => "Api.dispatcher.success.put"
        ];
    }
}
