<?php

declare(strict_types=1);

use App\Components\Shared\Forms\Fields\Date\DateFloatLabel\DateFloatLabel;
use App\Components\Shared\Forms\Fields\Email\EmailFloatLabel\EmailFloatLabel;
use App\Components\Shared\Forms\Fields\Input\InputFloatLabel\InputFloatLabel;
use App\Components\Shared\Forms\Fields\Phone\Simple\Phone;
use App\Components\Shared\Forms\Fields\Select\SelectFloatLabel\SelectFloatLabel;
use App\Database\Entities\Companies\CompanyEntity;

/**
 *  Template base para novos componentes
 *  Component: describe
 *  Caminho: components/private/company/form/information/describe
 *  @var CompanyEntity $company 
 * */
?>

<div component="describe">
    <div class="form-title mb-5">
        <h3 class="font-poppins text-lg text-black-400">Especificações Gerais</h3>
    </div>
    <div class="form-row flex flex-wrap justify-between">
        <div class="form-group w-100 md:w-48">
            <?= InputFloatLabel::render(
                label: "Razão Social/Nome da Empresa",
                required: "true",
                name: "name",
                maxLength: 150,
                value: $company->getName()
            ); ?>
        </div>
        <div class="form-group w-100 md:w-48">
            <?= DateFloatLabel::render(
                label: "Data de Inauguração",
                required: "true",
                name: "inscribed_at",
                placeholder: "Dia/Mês/Ano",
                value: $company->getInscribedAt()
            ); ?>
        </div>
    </div>
    <div class="form-row flex flex-wrap justify-between">
        <div class="form-group w-100 md:w-48">
            <?= Phone::render(
                label: "Celular (WhatsApp)",
                required: "true",
                name: "phone",
                value: $company->getDecryptPhone()
            ); ?>
        </div>
        <div class="form-group w-100 md:w-48">
            <?= EmailFloatLabel::render(
                label: "email",
                name: "email",
                value: $company->getDecryptEmail()
            ); ?>
        </div>
    </div>
    <div class="form-row flex flex-wrap justify-between">
        <div class="form-group w-100 md:w-48">
            <?= InputFloatLabel::render(
                label: "Documento",
                name: "document",
                value: $company->getDecryptDocument()
            ); ?>
        </div>
        <div class="form-group w-100 md:w-48">
            <?= SelectFloatLabel::render(
                label: "Tipo do Documento",
                name: "document_type",
                options: [
                    ["text" => "CNPJ", "value" => "CNPJ"],
                    ["text" => "CPF", "value" => "CPF"],
                    ["text" => "Outro", "value" => "OTHER"],
                ],
                value: $company->getDocumentType()
            ); ?>
        </div>
    </div>
</div>