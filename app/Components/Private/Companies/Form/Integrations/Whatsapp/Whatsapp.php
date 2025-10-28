<?php

namespace App\Components\Private\Companies\Form\Integrations\Whatsapp;

use App\Components\BaseComponents;
use App\Database\Entities\Integrations\IntegrationEntity;

class Whatsapp extends BaseComponents
{
    const ORIGIN = "components/private/companies/form/integrations/whatsapp";
    const PROPS = [
        "integration",
    ];

    public static function render(
        ?IntegrationEntity $integration = new IntegrationEntity(),
    ) {
        $settings = $integration->getDecryptSettings();

        $whatsApp = !empty($settings) ? (array) json_decode($settings) : [];

        $propsUpdated = self::PROPS;

        \array_push($propsUpdated, 'whatsApp');
        return Component(self::ORIGIN, compact($propsUpdated));
    }
}
