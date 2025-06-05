<?php

namespace App\Business\Charges;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Entities\Finances\ChargeClientEntity;
use App\Database\Entities\Finances\ChargeEntity;
use App\Database\Models\Clients\ClientsModel;
use App\Database\Models\Finances\ChargesClientsModel;
use App\Services\Mailer\Mailers\ChargeMail;

class ChargesNotifications
{
    public function sendClients(array $clients, string $title, ChargeEntity $charge)
    {
        $chargeMail = new ChargeMail();
        $clientsModel = new ClientsModel();
        $chargeClientModel = new ChargesClientsModel();

        foreach ($clients as $clientId) {
            $chargeClientEntity = new ChargeClientEntity();
            $chargeClientEntity->setClientId($clientId);
            $chargeClientEntity->setChargedId($charge->getId());

            $chargeClientModel->upsert($chargeClientEntity->toArray(true), $chargeClientEntity);
        }

        /** @var array{ClientEntity} */
        $foundClients = $clientsModel->where('email IS NOT NULL')->whereIn('id', $clients)->findAll();

        $chargeMail->send([
            "title" => $title,
            "chargeId" =>  $charge->getReference(),
            "hasService" => !empty($charge->getServiceId()),
            "recipients" => array_map(fn(ClientEntity $client) => [
                "email" => $client->getDecryptEmail(),
                "name" => $client->getName()
            ], $foundClients)

        ]);
    }
}
