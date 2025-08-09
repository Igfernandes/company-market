<?php

namespace App\Api\Operations\Forms\Services\Post;

use App\Business\Services\ServicesBusiness;
use App\Database\Entities\Clients\ClientEntity;
use App\Database\Entities\CustomForms\ClientFormHistoryEntity;
use App\Database\Models\CustomForms\ClientsFormsHistoryModel;
use App\Libraries\Exceptions\Exceptions;
use App\Services\DeviceNotifications\DeviceNotificationsService;
use App\Services\Mailer\Mailers\InscribeMail;
use App\Services\Notifications\NotificationsService;

class PostUseCases
{
    /**
     * @param array{
     *   package: string,
     *   service_id: integer
     * } $payload
     */
    public function execute(array $payload)
    {
        $servicesBusiness = new ServicesBusiness();
        $clientsFormsHistoryModel = new ClientsFormsHistoryModel();

        /** @var ClientFormHistoryEntity */
        $clientFormHistoryEntity = $clientsFormsHistoryModel->join("clients", "clients.id = clients_forms_history.client_id")->where([
            "package" => $payload['package']
        ])->first();

        if (empty($clientFormHistoryEntity))
            throw new Exceptions("Api.custom_forms.invalid.client", \BAD_REQUEST);

        /** @var ClientEntity */
        $clientEntity = new ClientEntity();
        $clientEntity->store($clientFormHistoryEntity->attributes);

        $response = $servicesBusiness->inscribe([
            "client_ids" => [$clientFormHistoryEntity->getClientId()],
            "service_id" => $payload['service_id']
        ]);

        if ($response === false)
            throw new Exceptions("Api.clients.services.invalid.not_found");

        InscribeMail::send([
            "recipients" => [
                [
                    "email" => $clientEntity->getDecryptEmail(),
                    "name" => $clientEntity->getName(),
                    "client_id" => $clientEntity->getId()
                ]
            ],
            "service" => $response['service']
        ]);

        $devicesNotification = new DeviceNotificationsService();
        $devicesNotification->handle([$clientEntity->getId()], [
            "title" => "CONFIRMAÇÃO PARA EVENTO: {$response['service']->getName()}",
            "content" => "Entre em contato com a AGM para confirmar a sua vaga",
            "url" =>  getenv('globals.href.frontend') . "/services/confirmation?key={$response['service']->getId()}"
        ]);

        NotificationsService::store([
            "scope" => "services",
            "action" => "UPDATE",
            "key" => $payload['service_id']
        ]);

        return (object)[
            "success" => "Api.services.success.inscribe"
        ];
    }
}
