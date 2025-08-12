<?php


namespace App\Api\Operations\Webhooks\WhatsApp\Post;

use App\Business\WebHooks\WhatsAppBusiness;
use App\Database\Entities\Integrations\IntegrationEntity;
use App\Database\Entities\MessagesDispatcher\ClientMessageDispatcherEntity;
use App\Database\Models\Integrations\IntegrationsModel;
use App\Database\Models\MessagesDispatcher\ClientsMessagesDispatcherModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;

class PostUseCases
{
    use BusinessTrait;

    /**
     * Processa o payload recebido do webhook do Facebook/Instagram Messenger.
     *
     * @param object{
     *   object: string, // geralmente "page"
     *   entry: array<int, object{
     *     id: string, // PAGE_ID
     *     time: int, // timestamp do evento
     *     messaging: array<int, object{
     *       sender: object{
     *         id: string // PSID do usuário
     *       },
     *       recipient: object{
     *         id: string // PAGE_ID da página que recebeu a mensagem
     *       },
     *       timestamp: int, // timestamp da mensagem
     *       message: object{
     *         text: string // texto da mensagem enviada pelo usuário
     *       }
     *     }>
     *   }>
     * } $payload
     */
    public function execute(object $payload)
    {

        if (!isset($payload->entry))
            throw new Exceptions("Api.whatsApp.invalid.not_found", \NOT_FOUND);

        $integrationsModel = new IntegrationsModel();

        /** @var IntegrationEntity */
        $integrationWhatsApp = $integrationsModel->where([
            'provider' => "WHATSAPP",
            'status' => "ACTIVE"
        ])->first();

        $clientsMessages = [];

        foreach ($payload->entry as $messages) {
            foreach ($messages->changes as $change) {
                $data = $change->value;
                $metadata = $data->metadata;

                if ($metadata->phone_number_id !== $integrationWhatsApp->getDecryptPublicToken())
                    continue;

                if ($data->messaging_product !== "whatsapp" || !\is_array($data->messages))
                    continue;

                foreach ($data->messages as $message) {
                    $clientsMessagesDispatcherModel = new ClientsMessagesDispatcherModel();

                    /** @var array{ClientMessageDispatcherEntity} */
                    $foundMessage = $clientsMessagesDispatcherModel->getClientsWithMessages([
                        "phone_sha256" => \referenceHash($message->from)
                    ], [
                        "status" => "ACTIVE",
                        "started_at <=" => date("Y-m-d H:i:s")
                    ], [
                        "status" => "PENDING"
                    ]);

                    if (\is_array($foundMessage) && count($foundMessage) > 0)
                        \array_push($clientsMessages, $foundMessage[0]);
                }
            }
        }

        $whatsAppBusiness = new WhatsAppBusiness();
        $whatsAppBusiness->handleSend($clientsMessages);
    }
}
