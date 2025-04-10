<?php

namespace App\Api\Integrations\Chats\Post;

use App\Business\Integrations\IntegrationsBusiness;
use App\Database\Entities\Integrations\IntegrationChatEntity;
use App\Database\Models\Integrations\IntegrationChatsModel;

class PostUseCases
{
    /**
     * @param array{
     *   type: "FACEBOOK"|"INSTAGRAM"|"WHATSAPP",
     *   public_token: string,
     *   private_token: string,
     *   username: string,
     *   login: string,
     *   password: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $integrationChatsModel = new IntegrationChatsModel();
        $integrationChatEntity = new IntegrationChatEntity();
        $integrationBusiness = new IntegrationsBusiness();

        $integrationBusiness->store($integrationChatEntity, $integrationChatsModel, $payload);

        return (object)[
            "success" => lang("Api.integrations.success.post")
        ];
    }
}
