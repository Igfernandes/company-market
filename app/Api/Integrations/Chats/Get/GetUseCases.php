<?php

namespace App\Api\Integrations\Chats\Get;

use App\Database\Entities\Integrations\IntegrationChatEntity;
use App\Database\Models\Integrations\IntegrationChatsModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\Integrations\IntegrationChatsDataTrait;

class GetUseCases
{
    use IntegrationChatsDataTrait, BusinessTrait;

    /**
     * @param array{
     *     id: int,
     *     in_ids: array<int>, 
     *     type: "FACEBOOK"|"INSTAGRAM"|"WHATSAPP",
     *     created_at: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $integrationChatsModel = new IntegrationChatsModel();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        if (count($in_ids) > 0)
            $integrationChatsModel->whereIn("id", $in_ids);

        $chats = $integrationChatsModel->where($filteredPayload)->findAll();

        if (!empty($payload['id']) && count($chats) > 0)
            return $this->builder($chats[0]);
        else if (!empty($payload['id']) && \count($chats) == 0)
            throw new Exceptions(lang("Errors.not_found"), \NOT_FOUND);

        $chatsData = array_map(
            fn(IntegrationChatEntity $integrationChat) => $this->builder($integrationChat),
            $chats
        );

        return \array_values($chatsData);
    }
}
