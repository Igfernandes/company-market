<?php

namespace App\Business\Integrations;

use App\Business\BaseBusiness;
use App\Database\Entities\Integrations\IntegrationEntity;
use App\Database\Models\Integrations\IntegrationsModel;

class IntegrationsSearchBusiness
{
    use BaseBusiness;

    public static function getOrderByProvider(array $query): array
    {
        $integrationsModel = new IntegrationsModel();

        /** @var array{IntegrationEntity} $founds */
        $founds = $integrationsModel->where($query)->findAll();
        $integrations = [];

        foreach ($founds as $integration) {
            $integrations[$integration->getProvider()] = $integration;
        }

        return $integrations;
    }
}
