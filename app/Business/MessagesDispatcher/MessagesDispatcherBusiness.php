<?php

namespace App\Business\MessagesDispatcher;

use App\Business\BaseBusiness;
use App\Business\Charges\ChargesBusiness;
use App\Business\Services\ServicesBusiness;
use App\Database\Entities\MessagesDispatcher\MessageDispatcherEntity;
use App\Database\Models\MessagesDispatcher\MessagesDispatcherModel;

class MessagesDispatcherBusiness
{
    use BaseBusiness;

    private MessagesDispatcherModel $messagesDispatcherModel;

    public function __construct()
    {
        $this->messagesDispatcherModel = new MessagesDispatcherModel();
    }

    public function hasMessageDispatcher($query): bool
    {
        $found = $this->messagesDispatcherModel->where($query)->first();

        return !empty($found);
    }

    /**
     * @param array{int} $clientsId 
     * @param MessageDispatcherEntity $messageDispatcherEntity
     */

    public function send(array $clientsId, MessageDispatcherEntity $messageDispatcherEntity)
    {
        $actions = [
            "EMAIL" => new EmailDispatcherBusiness(),
            "WHATSAPP" => new WhatsAppDispatcherBusiness(),
            "FACEBOOK" => new FacebookDispatcherBusiness()
        ];

        $platforms = \explode(",", $messageDispatcherEntity->getPlatforms());

        foreach ($platforms as $platform) {
            $actions[$platform]->execute($messageDispatcherEntity, $clientsId);
        }
    }

    /**
     * @param array{
     *  content:string,
     *  service_id: integer,
     *  charge_id: integer
     * } $payload 
     */
    function hasContentToSend(array $payload): bool
    {
        $hasValue = \array_filter($payload, fn($field) => !empty($field));

        if (count($hasValue) === 0)
            return false;

        $servicesBusiness = new ServicesBusiness();

        if (!empty($payload['service_id']) && $servicesBusiness->hasService([
            "id" => $payload['service_id']
        ]))
            return true;

        $chargesBusiness = new ChargesBusiness();

        if (!empty($payload['charge_id']) && $chargesBusiness->hasCharge([
            "id" => $payload['charge_id']
        ]))
            return true;

        if (!empty($payload['content']))
            return true;

        return false;
    }
}
