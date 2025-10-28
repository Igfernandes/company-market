<?php

namespace App\Api\Operations\Integrations\Post;

use App\Database\Entities\Integrations\IntegrationEntity;
use App\Database\Models\Integrations\IntegrationsModel;
use App\Libraries\Crypto\Crypto;
use App\Services\Notifications\NotificationsService;
use CodeIgniter\HTTP\Response;
use Exception;

class PostUseCases
{
    /**
     * @param array{
     *   company_id: int,
     *   integrations: array{array{string}}
     * } $payload
     */
    public function execute(array $payload)
    {
        $integrationModel = new IntegrationsModel();
        $integrationEntity = new IntegrationEntity();

        if (!is_object($payload['integrations']))
            throw new Exception("Api.integrations.invalid.payload", Response::HTTP_NOT_ACCEPTABLE);

        $integrationModel = new IntegrationsModel();
        $crypto = new Crypto();
        $integrationsModel = new IntegrationsModel();

        foreach ($payload['integrations'] as $provider => $data) {
            $integrationEntity = new IntegrationEntity();

            if (!isset($data->type))
                throw new Exception("Api.integrations.invalid.type", Response::HTTP_NOT_ACCEPTABLE);

            /** @var IntegrationEntity $found  */
            $found =  $integrationsModel->where([
                "provider" => $provider,
                "type" => $data->type
            ])->first();

            if (!empty($found))
                $integrationEntity = $found;

            $integrationEntity->setCompanyId($payload["company_id"]);
            $integrationEntity->setProvider($provider);
            $integrationEntity->setType($data->type);
            $integrationEntity->setStatus("ACTIVE");
            unset($data->type);

            $integrationEntity->setSystemKey($crypto->encrypt($provider, getenv('system.encrypted_key')));

            $integrationEntity->setEncryptSettings(json_encode($data));
            $integrationModel->save($integrationEntity);
        }

        NotificationsService::store([
            "scope" => "integrations",
            "action" => "UPDATE"
        ]);

        return (object)[
            "success" => "Api.integrations.success.post"
        ];
    }
}
