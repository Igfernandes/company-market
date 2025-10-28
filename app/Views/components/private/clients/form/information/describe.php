<?php

declare(strict_types=1);

use App\Components\Shared\Forms\Fields\Date\DateFloatLabel\DateFloatLabel;
use App\Components\Shared\Forms\Fields\Email\EmailFloatLabel\EmailFloatLabel;
use App\Components\Shared\Forms\Fields\Input\InputFloatLabel\InputFloatLabel;
use App\Components\Shared\Forms\Fields\Phone\Simple\Phone;
use App\Components\Shared\Forms\Fields\Select\SelectFloatLabel\SelectFloatLabel;
use App\Database\Entities\Clients\ClientEntity;

/**
 *  Template base para novos componentes
 *  Component: describe
 *  Caminho: components/private/clients/form/information/describe
 *  @var ClientEntity $client 
 * */
?>

<div component="describe">
    <div class="form-title mb-5">
        <h3 class="font-poppins text-lg text-black-400">Especificações Gerais</h3>
    </div>
    <div class="form-row flex flex-wrap justify-between">
        <div class="form-group w-100 md:w-48">
            <?= InputFloatLabel::render(
                label: "Nome Completo",
                required: "true",
                name: "name",
                maxLength: 150,
                value: $client->getName()
            ); ?>
        </div>
        <div class="form-group w-100 md:w-48">
            <?= DateFloatLabel::render(
                label: "Aniversário",
                required: "true",
                name: "birthdate",
                placeholder: "Dia/Mês/Ano",
                value: $client->getBirthdate()
            ); ?>
        </div>
    </div>
    <div class="form-row flex flex-wrap justify-between">
        <div class="form-group w-100 md:w-48">
            <?= Phone::render(
                label: "Celular (WhatsApp)",
                required: "true",
                name: "phone",
                value: $client->getDecryptPhone()
            ); ?>
        </div>
        <div class="form-group w-100 md:w-48">
            <?= EmailFloatLabel::render(
                label: "email",
                name: "email",
                value: $client->getDecryptEmail()
            ); ?>
        </div>
    </div>
    <div class="form-row flex flex-wrap justify-between">
        <div class="form-group w-100 md:w-48">
            <?= InputFloatLabel::render(
                label: "Documento",
                name: "document",
                value: $client->getDecryptDocument()
            ); ?>
        </div>
        <div class="form-group w-100 md:w-48">
            <?= SelectFloatLabel::render(
                label: "Tipo do Documento",
                name: "document_type",
                options: [
                    ["text" => "CPF", "value" => "CPF"],
                    ["text" => "RG", "value" => "RG"],
                    ["text" => "PASSAPORTE", "value" => "PASSAPORTE"],
                    ["text" => "Outro", "value" => "OTHER"],
                ],
                value: $client->getDocumentType()
            ); ?>
        </div>

    </div>
</div>