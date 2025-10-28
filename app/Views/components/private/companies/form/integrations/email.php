<?php

declare(strict_types=1);

use App\Components\Shared\Forms\Fields\Input\InputFloatLabel\InputFloatLabel;
use App\Components\Shared\Forms\Fields\Select\SelectFloatLabel\SelectFloatLabel;

/**
 *  Template base para novos componentes
 *  Component: email
 *  Caminho: components/private/companies/form/integrations/email
 */

?>

<div component="email">
    <div class="mt-10 mb-3">
        <h2 class="font-poppins text-theme text-lg">E-mail</h2>
    </div>
    <hr>
    <input type="hidden" name="integrations[email][type]" value="CHAT">
    <div class="form-group">
        <?=
        InputFloatLabel::render(
            name: 'integrations[email][login]',
            label: 'Login',
            type: 'text',
            value: $email['login'] ?? null,
            placeholder: 'Insira o login'
        );
        ?>
    </div>
    <div class="form-group">
        <?=
        InputFloatLabel::render(
            name: 'integrations[email][password]',
            label: 'A senha',
            type: 'text',
            value: $email['password'] ?? null,
            placeholder: 'Insira a senha do serviço de e-mail'
        );
        ?>
    </div>
    <div class="form-group">
        <?=
        InputFloatLabel::render(
            name: 'integrations[email][port]',
            label: 'A porta SMTP',
            type: 'text',
            value: $email['port'] ?? null,
            placeholder: 'Insira a porta smtp do e-mail'
        );
        ?>
    </div>
    <div class="form-group">
        <?=
        InputFloatLabel::render(
            name: 'integrations[email][host]',
            label: 'O host do e-mail',
            type: 'text',
            value: $email['host'] ?? null,
            placeholder: 'Insira o host do e-mail'
        );
        ?>
    </div>
    <div class="form-group">
        <?=
        SelectFloatLabel::render(
            name: 'integrations[email][smtpsecure]',
            label: 'O tipo de protocolo de segurança do e-mail',
            options: [
                [
                    "text" => "tls",
                    "value" => "tls"
                ],
                [
                    "text" =>  "ssl",
                    "value" => "ssl"
                ],
                [
                    "text" =>  "none",
                    "value" => "none"
                ]
            ],
            value: $email['smtpsecure'] ?? null
        );
        ?>
    </div>
    <div class="form-group">
        <?=
        InputFloatLabel::render(
            name: 'integrations[email][from]',
            label: 'O e-mail que irá enviar',
            type: 'text',
            value: $email['from'] ?? null,
            placeholder: 'Insira o e-mail que irá disparar'
        );
        ?>
    </div>
    <div class="form-group">
        <?=
        InputFloatLabel::render(
            name: 'integrations[email][author]',
            label: 'O autor do e-mail',
            type: 'text',
            value: $email['author'] ?? null,
            placeholder: 'Insira o autor do e-mail'
        );
        ?>
    </div>
</div>