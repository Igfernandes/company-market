<?php

namespace App\Api\MessagesDispatcher\Put;

use App\Business\MessagesDispatcher\ScheduleDispatcherBusiness;
use App\Database\Models\MessagesDispatcher\MessagesDispatcherModel;
use App\Libraries\Exceptions\Exceptions;

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
            throw new Exceptions(\str_replace("{field}", lang("Words.dispatcher"), lang("Validation.not_found")), \BAD_BUSINESS_RULES);

        $messagesDispatcherModel->set([
            "status" => $payload['status']
        ])->where([
            "id" => $payload['id']
        ])->update();

        if (\is_array($payload['clients']) && \count($payload['clients']) > 0) {
            ScheduleDispatcherBusiness::scheduleDispatcherClients($payload['clients'], $dispatcher);
        }

        return (object)[
            "success" => lang("Api.dispatcher.success.put")
        ];
    }
}
