<?php

namespace App\Components\Private\Companies\Form\Integrations\Email;

use App\Components\BaseComponents;
use App\Database\Entities\Integrations\IntegrationEntity;

class Email extends BaseComponents
{
    const ORIGIN = "components/private/companies/form/integrations/email";
    const PROPS = [
        "integration",
    ];

    public static function render(
        ?IntegrationEntity $integration = new IntegrationEntity(),
    ) {
        $settings = $integration->getDecryptSettings();

        $email = !empty($settings) ? (array) json_decode($settings) : [];

        $propsUpdated = self::PROPS;
        \array_push($propsUpdated, 'email');

        return Component(self::ORIGIN, compact($propsUpdated));
    }
}
