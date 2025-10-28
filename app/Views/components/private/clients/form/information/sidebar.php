<?php

declare(strict_types=1);

use App\Components\Shared\Forms\Fields\Input\InputFloatLabel\InputFloatLabel;
use App\Components\Shared\Forms\Fields\Select\SelectFloatLabel\SelectFloatLabel;
use App\Components\Shared\Forms\Fields\Submit\Submit;
use App\Components\Shared\Forms\Fields\SwitchButton\SwitchButton;
use App\Components\Shared\Utils\Snapshot\Snapshot;
use App\Database\Entities\Clients\ClientEntity;

/**
 *  Template base para novos componentes
 *  Component: sidebar
 *  Caminho: components/private/clients/form/sidebar
 *  @var ClientEntity $client 
 */

?>

<aside component="sidebar" class="bg-white pb-6 pt-4 px-4 rounded-md shadow-md">
    <?php if (isset($id) && !empty($id)): ?>
        <div class="hidden">
            <?= InputFloatLabel::render(
                type: "hidden",
                name: "id",
                value: strval($id),
            ); ?>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <?= Snapshot::render(
            ref: "avatar",
            api: "/api/clients/{$client->getId()}",
            operation: "avatar",
            src: $client->getAvatar()
        ) ?>
    </div>
    <div class="text-center mt-6">
        <span class="text-theme"><strong>Status</strong></span>
        <div>
            <?= SwitchButton::render(
                name: "status",
                id: "status",
                value: strval($client->getStatus() ?? "ACTIVE"),
                left: [
                    "title" => "Ativo",
                    "value" => "ACTIVE"
                ],
                right: [
                    "title" => "Inativo",
                    "value" => "INACTIVE"
                ]
            ) ?>
        </div>
    </div>
    <?php if (isset($id) && !empty($id)): ?>
        <div class="text-center rounded-sm text-sm border-r-2  border-2 border-theme py-1 px-2 mt-4">
            <p class="text-gray-600"><strong>Criado em:</strong></p>
            <span class="text-xs font-600 text-gray-900"><i><?= (new DateTime($client->getCreatedAt()))->format("d/m/Y H:i"); ?></i></span>
        </div>
        <div class="text-center rounded-sm text-sm border-r-2 border-2 border-theme  py-1 px-2 mt-4">
            <p class="text-gray-600"><strong>Atualizado em:</strong></p>
            <span class="text-xs font-600 text-gray-900"><i><?= (new Datetime($client->getUpdatedAt()))->format("d/m/Y H:i") ?></i></span>
        </div>
    <?php endif; ?>

    <div class="form-group mt-6">
        <?= SelectFloatLabel::render(
            name: "category",
            id: "category",
            label: "Categoria",
            required: "true",
            value: strval($categoryId ?? ""),
            options: [
                [
                    "text" => "Selecione",
                    "value" => null
                ],
                ...$categories
            ]
        ); ?>
    </div>
    <div class="form-group mt-6">
        <?= SelectFloatLabel::render(
            name: "company",
            id: "company",
            label: "Empresa Relacionada",
            required: "true",
            value: strval($client->getCompanyId()),
            options: [
                [
                    "text" => "Selecione",
                    "value" => null
                ],
                ...$companies
            ]
        ); ?>
    </div>
    <div class="mt-6">
        <?= Submit::render(
            text: "Salvar"
        ) ?>
    </div>
</aside>