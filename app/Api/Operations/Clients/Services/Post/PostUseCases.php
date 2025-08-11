<?php

namespace App\Api\Operations\Clients\Services\Post;

use App\Business\Services\ServicesBusiness;
use App\Database\Entities\Clients\ClientEntity;
use App\Database\Models\Clients\ClientsModel;
use App\Database\Models\Services\ClientsServicesModel;
use App\Database\Models\Services\ServicesModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\DeviceNotifications\DeviceNotificationsService;
use App\Services\Mailer\Mailers\InscribeMail;
use App\Services\Mailer\Mailers\UnsubscribeMail;
use App\Services\Notifications\NotificationsService;

class PostUseCases
{
    /**
     * @param array{
     *   client_ids: array{integer},
     *   service_id: integer
     * } $payload
     */
    public function execute(array $payload)
    {
        $servicesBusiness = new ServicesBusiness();
        $clientsServicesModel = new ClientsServicesModel();
        $response = (object)[
            "success" => "Api.clients.services.success.post"
        ];

        if (!is_array($payload['client_ids']))
            throw new Exceptions("Api.clients.invalid.id", \BAD_REQUEST);

        $servicesModel = new ServicesModel();
        $service = $servicesModel->where("id", $payload['service_id'])->first();

        if (empty($service) || $service->getStatus() === "INACTIVE")
            throw new Exceptions("Api.clients.services.invalid.status");

        if (count($payload['client_ids']) === 0) {
            $clientsServicesModel->where("service_id", $payload['service_id'])->delete();
            return $response;
        }

        $response = $servicesBusiness->inscribe($payload);

        if ($response === false)
            throw new Exceptions("Api.clients.services.invalid.not_found");

        $clientsModel = new ClientsModel();
        /** @var array{ClientEntity} */
        $clients = $clientsModel->whereIn("id", [...$response['inscribes'], ...$response['excludes']])->findAll();

        $inscribesData = [];
        $excludesData = [];
        foreach ($clients as $client) {
            if (empty($client->getDecryptEmail()))
                continue;

            if (\array_search($client->getId(), $response['inscribes']) !== false) {
                \array_push($inscribesData, [
                    "email" => $client->getDecryptEmail(),
                    "name" => $client->getName(),
                    "client_id" => $client->getId()
                ]);
            } else {
                \array_push($excludesData, [
                    "email" => $client->getDecryptEmail(),
                    "name" => $client->getName()
                ]);
            }
        }

        if (count($inscribesData) > 0)
            InscribeMail::send([
                "recipients" => $inscribesData,
                "service" => $service
            ]);

        if (\count($excludesData) > 0)
            UnsubscribeMail::send([
                "recipients" => $excludesData,
                "service" => $service
            ]);

        $devicesNotification = new DeviceNotificationsService();
        $devicesNotification->handle($payload['client_ids'], [
            "title" => "CONFIRMAÇÃO PARA EVENTO: {$service->getName()}",
            "content" => "Entre em contato com a AGM para confirmar a sua vaga"
        ]);

        NotificationsService::store([
            "scope" => "services",
            "action" => "UPDATE",
            "key" => $payload['service_id']
        ]);

        return $response;
    }
}
