<?php

namespace App\Api\Integrations\Banks\Post;

use App\Business\Integrations\IntegrationsBusiness;
use App\Database\Entities\Integrations\IntegrationBankEntity;
use App\Database\Models\Integrations\IntegrationBanksModel;

class PostUseCases
{
    /**
     * @param array{
     *   type: "MERCADO_PAGO",
     *   public_token: string,
     *   private_token: string,
     *   username: string,
     *   login: string,
     *   password: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $integrationBankModel = new IntegrationBanksModel();
        $integrationBankEntity = new IntegrationBankEntity();
        $integrationBusiness = new IntegrationsBusiness();

        $integrationBusiness->store($integrationBankEntity, $integrationBankModel, $payload);

        return (object)[
            "success" => lang("Api.integrations.success.post")
        ];
    }
}
