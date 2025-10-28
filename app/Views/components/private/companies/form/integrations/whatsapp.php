<?php

declare(strict_types=1);

use App\Components\Shared\Forms\Fields\Input\InputFloatLabel\InputFloatLabel;
use App\Database\Entities\Integrations\IntegrationEntity;

/**
 *  Template base para novos componentes
 *  Component: whatsapp
 *  Caminho: components/private/companies/form/integrations/whatsapp
 * 
 * @var array $whatsApp
 */

?>

<div component="whatsapp">
    <div class="mt-10 mb-3">
        <h2 class="font-poppins text-theme text-lg">WhatsApp</h2>
    </div>
    <hr>
    <input type="hidden" name="integrations[whatsapp][type]" value="CHAT">
    <div class="form-group">
        <?=
        InputFloatLabel::render(
            name: 'integrations[whatsapp][public_key]',
            label: 'Chave Pública da API',
            type: 'text',
            value: $whatsApp['public_key'] ?? null,
            placeholder: 'Insira a chave da API Pública'
        );
        ?>
    </div>
    <div class="form-group">
        <?=
        InputFloatLabel::render(
            name: 'integrations[whatsapp][private_key]',
            label: 'Chave Privada da API',
            type: 'text',
            value: $whatsApp['private_key'] ?? null,
            placeholder: 'Insira a chave da API Privada'
        );
        ?>
    </div>

</div>