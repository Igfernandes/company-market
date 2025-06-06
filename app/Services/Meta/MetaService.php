<?php

namespace App\Services\Meta;

use App\Database\Models\Integrations\IntegrationsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Libraries\HttpClient\HttpClient;
use App\Services\Meta\Operations\SanitizerForMessenger;

class MetaService
{
    private string $accessToken;
    private string $pageId;
    private string $api;

    public function __construct(string $platform)
    {
        $integrationsModel = new IntegrationsModel();

        /** @var IntegrationEntity */
        $integrationWhatsApp = $integrationsModel->where("provider", $platform)->first();

        if (empty($integrationWhatsApp->getDecryptPublicToken()) || empty($integrationWhatsApp->getDecryptPrivateToken()))
            throw new Exceptions(\str_replace("{field}", "credentials", lang("Validation.not_found")), \BAD_AUTH);

        $this->accessToken = $integrationWhatsApp->getDecryptPrivateToken();
        $this->pageId = $integrationWhatsApp->getDecryptPublicToken();
        $this->api = \getenv('private.meta.api');
    }

    /**
     * Envia uma mensagem para uma lista de usuários (PSIDs) via Facebook ou Instagram Messenger.
     *
     * Este método percorre uma lista de clientes, determina a plataforma de envio (Facebook ou Instagram),
     * sanitiza a mensagem para evitar bloqueios, e realiza o envio utilizando a API Graph do Facebook.
     * O envio utiliza a tag "ACCOUNT_UPDATE", recomendada para mensagens fora da janela de 24 horas.
     *
     * @param array $clientsPSID Lista de usuários com estrutura:
     *                            [
     *                                ['id' => 'USER_PSID', 'platform' => 'FACEBOOK'|'INSTAGRAM'],
     *                                ...
     *                            ]
     * @param string $message A mensagem de texto a ser enviada. Pode conter HTML, que será sanitizado.
     *
     * @return void
     *
     * @throws \Exception Caso ocorra erro na requisição HTTP (dependente da implementação do HttpClient).
     *
     * @example
     * $notifier->send([
     *     ['id' => '1234567890', 'platform' => 'FACEBOOK'],
     *     ['id' => '0987654321', 'platform' => 'INSTAGRAM']
     * ], 'Olá! Atualizamos seus dados.');
     */
    public function send(array $clientsPSID, string $message)
    {

        foreach ($clientsPSID as $psid) {
            $pageAccessToken = $psid['platform']  === "FACEBOOK" ?
                getenv('globals.meta.facebook.access_token') :
                getenv('globals.meta.instagram.access_token');

            $payload = [
                'recipient' => ['id' => $psid],
                'message' => ['text' => SanitizerForMessenger::get($message)],
                'messaging_type' => 'MESSAGE_TAG',
                'tag' => 'ACCOUNT_UPDATE' // necessário se fora da janela de 24h
            ];

            $url = "https://graph.facebook.com/v19.0/me/messages?access_token={$pageAccessToken}";

            HttpClient::request("POST", $url, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $pageAccessToken,
            ], $payload);
        }
    }

    public function getTokenPage()
    {
        $response = HttpClient::request("GET", "{$this->api}/{$this->pageId}/owned_pages?access_token={$this->accessToken}", [
            'Content-Type: application/json',
        ]);

        $data = \json_decode($response['responde']);

        return isset($data[0]) ? $data[0]->access_token : null;
    }

    public function
    postWithImage(string $message, string $image)
    {
        $payload = [
            'url' => $image,
            'caption' => SanitizerForMessenger::get($message),
            'published' => true, // ou false para deixar como rascunho
            'access_token' => $this->getTokenPage()
        ];

        return  HttpClient::request("POST", "{$this->api}/{$this->pageId}/photos", [
            'Content-Type: application/x-www-form-urlencoded',
        ], $payload);
    }

    public function postSimple(string $message)
    {
        $payload = [
            'message' => SanitizerForMessenger::get($message),
            'published' => true, // ou false para deixar como rascunho
            'access_token' => $this->getTokenPage()
        ];

        return HttpClient::request("POST", "{$this->api}/{$this->pageId}/feed", [
            'Content-Type: application/json',
        ], $payload);
    }


    /**
     * @param string $object
     * 
     */
    public function getTypePlatform(string $object)
    {
        if (empty($object)) return "undefined";

        switch ($object):
            case "page":
                return "FACEBOOK";
            case "instagram":
                return "INSTAGRAM";
        endswitch;
    }

    /**
     * @param array<int, object{
     *   sender: object{ id: string },              // PSID do usuário que enviou a mensagem
     *   referral: object{ platform_key: string}
     *   recipient: object{ id: string },           // ID da página que recebeu a mensagem
     *   timestamp: int,                            // Timestamp do evento
     *   message: object{ text: string }            // Conteúdo da mensagem de texto
     * }> $messaging
     * @param string $platform
     */
    public function getUserId(array $messaging, $platform)
    {
        $users = [];

        foreach ($messaging as $scope) {
            array_push($users, [
                "platform" => $this->getTypePlatform($platform),
                "id" => $scope->sender->id,
                "user" => isset($scope->referral->platform_key) ? $scope->referral->platform_key : null,
                "message" => $scope->message->text
            ]);
        }

        return $users;
    }
}
