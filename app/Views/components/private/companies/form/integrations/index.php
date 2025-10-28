<?php

use App\Components\Private\Companies\Form\Integrations\Email\Email;
use App\Components\Private\Companies\Form\Integrations\Whatsapp\Whatsapp;
use App\Components\Shared\Forms\Fields\Submit\Submit;

?>
<div component='companies:integrations' class="w-100 md:w-50">
    <form send="integrations">
        <div class="form-title mt-6 mb-6">
            <h1 class="font-poppins text-gray-400 header-xs">Credenciais de Conexão</h1>
            <p>Abaixo estão os campos necessários a serem preenchidos para que haja a conexão com os serviços listados.</p>
        </div>
        <div class="form-hidden">
            <input type="hidden" name="company_id" value="<?= $company->getId() ?>" />
        </div>
        <?php
        Whatsapp::render(
            integration: $integrations['whatsapp']
        );
        Email::render(
            integration: $integrations['email']
        );
        ?>
        <div class="mt-6">
            <?= Submit::render(
                text: "Salvar"
            ) ?>
        </div>
    </form>
</div>