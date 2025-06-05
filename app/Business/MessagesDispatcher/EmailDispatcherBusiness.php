<?php

namespace App\Business\MessagesDispatcher;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Entities\MessagesDispatcher\MessageDispatcherEntity;
use App\Database\Models\Clients\ClientsModel;
use App\Services\Mailer\Mailers\ChargeMail;
use App\Services\Mailer\Mailers\MessageMail;
use App\Services\Mailer\Mailers\ServiceMail;
use App\Services\Mailer\Operations\Store;

class EmailDispatcherBusiness
{
    /**
     * @param array{int} $clientsId 
     * @param MessageDispatcherEntity $messageDispatcherEntity
     */
    public function execute(MessageDispatcherEntity $messageDispatcherEntity, array $clientsId)
    {
        $mails = [
            "service" => new ServiceMail(),
            "charge" => new ChargeMail(),
            "message" => new MessageMail()
        ];

        $clientsModel = new ClientsModel();
        $clients = $clientsModel->whereIn("id", $clientsId)->Where("email IS NOT NULL", null, false)->findAll();

        $mailData = [
            "recipients" => \array_map(function (ClientEntity $client) {

                return [
                    "email" => $client->getDecryptEmail(),
                    "name" => $client->getName()
                ];
            }, $clients)
        ];

        $serviceId = $messageDispatcherEntity->getServiceId();
        $chargeId = $messageDispatcherEntity->getChargeId();
        if (!empty($messageDispatcherEntity->getServiceId())) {
            $mailData['serviceId'] = $serviceId;
            $mailData['hasService'] = true;
            $mails['service']->send($mailData);
        } elseif (!empty($chargeId)) {
            $mailData['chargeId'] = $chargeId;
            $mails['charge']->send($mailData);
        } else {
            $mailData['content'] = $messageDispatcherEntity->getContent();
            $mails['message']->send($mailData);
        }

        Store::execute($clientsId, $messageDispatcherEntity->getId());
    }
}
