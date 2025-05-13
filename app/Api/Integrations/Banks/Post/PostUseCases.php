<?php

namespace App\Api\Integrations\Banks\Post;

use App\Business\Integrations\IntegrationsBusiness;
use App\Database\Entities\Integrations\IntegrationBankEntity;
use App\Database\Models\Integrations\IntegrationBanksModel;
use App\Services\MercadoPago\MercadoPago;

class PostUseCases
{

    private array $providers = [
        "MERCADO_PAGO" => MercadoPago::class
    ];

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

        if (isset($this->providers[$payload['type']])) {
            $providerInstance = $this->providers[$payload['type']];
            $provider = new $providerInstance($integrationBankEntity->getDecryptPrivateToken());
            $provider->init();
        }

        return (object)[
            "success" => lang("Api.integrations.success.post")
        ];
    }
}
