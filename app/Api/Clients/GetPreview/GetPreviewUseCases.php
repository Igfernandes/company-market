<?php

namespace App\Api\Clients\GetPreview;

use App\Database\Entities\Clients\ClientEntity;
use App\Database\Models\Clients\ClientsModel;
use App\Traits\BusinessTrait;
use App\Traits\Clients\ClientsDataTrait;

class GetPreviewUseCases
{
    use ClientsDataTrait, BusinessTrait;

    /**
     * @param array{
     *     phone: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $clientsModel = new ClientsModel();

        $filteredPayload['phone_sha256'] = referenceHash($filteredPayload['phone']);
        unset($filteredPayload['phone']);

        /** @var ClientEntity */
        $foundClient = $clientsModel->where($filteredPayload)->first();

        if (empty($foundClient)) return [];

        return  [
            "name" => $foundClient->getName(),
            "email" => $foundClient->getDecryptEmail(),
            "phone" => $foundClient->getDecryptPhone()
        ];
    }
}
