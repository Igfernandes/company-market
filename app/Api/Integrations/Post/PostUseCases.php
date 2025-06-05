<?php

namespace App\Api\Integrations\Post;

use App\Business\Integrations\IntegrationsBusiness;
use App\Database\Entities\Integrations\IntegrationEntity;
use App\Database\Models\Integrations\IntegrationsModel;

class PostUseCases
{
    /**
     * @param array{
     *   type: string,
     *   public_token: string,
     *   status: 'ACTIVE'|'INACTIVE',
     *   private_token: string,
     *   username: string,
     *   login: string,
     *   password: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $integrationModel = new IntegrationsModel();
        $integrationEntity = new IntegrationEntity();
        $integrationBusiness = new IntegrationsBusiness();

        $integrationBusiness->store($integrationEntity, $integrationModel, $payload);

        return (object)[
            "success" => lang("Api.integrations.success.post")
        ];
    }
}
