<?php

namespace App\Services\WhatsApp;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Entities\Integrations\IntegrationEntity;
use App\Database\Models\Clients\ClientsModel;
use App\Database\Models\Integrations\IntegrationsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Libraries\HttpClient\HttpClient;
use App\Services\WhatsApp\Operations\Store;
use App\Services\WhatsApp\Traits\MessagesTrait;

class WhatsAppService
{
    use MessagesTrait;

    private string $accessToken;
    private string $phoneId;
    private string $api;
    private array $feedbacks = [
        400 => "Api.invalids.phone",
        401 => "Api.invalids.credentials",
        200 => "Api.success.send_message",
        201 => "Api.success.send_message"
    ];

    public function __construct()
    {
        $integrationsModel = new IntegrationsModel();

        /** @var IntegrationEntity */
        $integrationWhatsApp = $integrationsModel->where("provider", "WHATSAPP")->first();

        if (empty($integrationWhatsApp->getDecryptPublicToken()) || empty($integrationWhatsApp->getDecryptPrivateToken()))
            throw new Exceptions(\str_replace("{field}", "credentials", lang("Validation.not_found")), \BAD_AUTH);

        $this->accessToken = $integrationWhatsApp->getDecryptPrivateToken();
        $this->phoneId = $integrationWhatsApp->getDecryptPublicToken();
        $this->api = \getenv('private.meta.api');
    }

    public function welcome(array $clientsId)
    {
        $clientsModel = new ClientsModel();

        $clients = $clientsModel->whereIn("id", $clientsId)->findAll();
        $clientsFeedback = [];

        foreach ($clients as  $client) {
            $payload = [
                "messaging_product" => "whatsapp",
                "to" => $client->getDecryptPhone(),
                "type" => "template",
                "template" => [
                    "name" => "hello_world",
                    "language" => ["code" => "en_US"]
                ]
            ];

            $url = $this->api . "/{$this->phoneId}/messages";

            $response = HttpClient::request("POST", $url, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->accessToken,
            ], $payload);

            $response['client_id'] = $client->getId();

            if (!isset($clientsFeedback[$response['status']]))
                $clientsFeedback[$response['status']] = [];

            array_push($clientsFeedback[$response['status']], $response);
        }
    }

    public function notification(array $clientsId, int $messageId = 0)
    {
        $clientsModel = new ClientsModel();

        $clients = $clientsModel->whereIn("id", $clientsId)->findAll();
        $clientsFeedback = [];

        foreach ($clients as  $client) {
            $payload = [
                "messaging_product" => "whatsapp",
                "to" => $client->getDecryptPhone(),
                "type" => "template",
                "template" => [
                    "name" => "notifications",
                    "language" => ["code" => "pt_BR"],
                    "components" => [
                        [
                            "type" => "button",
                            "sub_type" => "quick_reply",
                            "index" => 0,
                            "parameters" => []
                        ]

                    ]
                ]
            ];

            $url = $this->api . "/{$this->phoneId}/messages";

            $response = HttpClient::request("POST", $url, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->accessToken,
            ], $payload);

            $response['client_id'] = $client->getId();

            if (!isset($clientsFeedback[$response['status']]))
                $clientsFeedback[$response['status']] = [];

            array_push($clientsFeedback[$response['status']], $response);
        }

        Store::execute($clientsFeedback, $messageId);
    }


    public function send(ClientEntity $client, string $message, string $imageUrl = "")
    {
        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => $client->getDecryptPhone(),
            'type' => 'text'
        ];

        if ($imageUrl != "") {
            $payload['type'] = "image";
            $payload['image'] = [
                "link" => $imageUrl,
                "caption" => $this->convertHtmlToWhatsAppText($message)
            ];
        } else {
            $payload['text'] = [
                'body' => $this->convertHtmlToWhatsAppText($message)
            ];
        }

        $url = $this->api . "/{$this->phoneId}/messages";

        $response = HttpClient::request("POST", $url, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->accessToken,
        ], $payload);

        // file_put_contents('webhook.log', "\n" . \json_encode(["POST", $url, [
        //     'Content-Type: application/json',
        //     'Authorization: Bearer ' . $this->accessToken,
        // ], $payload]), FILE_APPEND);

        return $response['status'] === OK;
    }
}
