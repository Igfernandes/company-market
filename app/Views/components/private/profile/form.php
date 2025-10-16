<?php

declare(strict_types=1);

use App\Components\Shared\Forms\Fields\Email\EmailIcon\EmailIcon;
use App\Components\Shared\Forms\Fields\Date\DateIcon\DateIcon;
use App\Components\Shared\Forms\Fields\Input\InputIcon\InputIcon;
use App\Components\Shared\Forms\Fields\Phone\Simple\Phone;
use App\Components\Shared\Forms\Fields\Submit\Submit;
use App\Components\Shared\Forms\Fields\SwitchButton\SwitchButton;
use App\Components\Shared\Utils\Snapshot\Snapshot;
use App\Database\Entities\Users\UserEntity;

/** @var UserEntity $user */

?>
<div component="profile:form" class="mt-8 pb-6">
    <form send='user-update'>
        <?php if (isset($id)): ?>
            <div class="hidden">
                <?= InputIcon::render(
                    type: "hidden",
                    name: "id",
                    value: strval($id),
                ); ?>
            </div>
        <?php endif; ?>
        <div class="form-header flex flex-wrap items-center mb-5">
            <div class="w-100 md:w-50">
                <div class="flex flex-wrap">
                    <div class="w-20 mr-5">
                        <?= Snapshot::render(
                            ref: "profile",
                            api: "/api/users/{$user->getId()}",
                            operation: "avatar",
                            src: $user->getAvatar()
                        ) ?>
                    </div>
                    <div class="text-center inline-block">
                        <span class="text-accent"><strong>Status</strong></span>
                        <div>
                            <?= SwitchButton::render(
                                name: "status",
                                id: "status",
                                value: strval($user->getStatus()),
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
                </div>
            </div>
            <div class="w-100 md:w-50">
                <div class="flex justify-end">
                    <div class="text-sm text-center border-r-2 border-gray-300 px-2">
                        <p><strong>Criado em:</strong></p>
                        <span><?= (new Datetime($user->getCreatedAt()))->format("d/m/Y H:i"); ?></span>
                    </div>
                    <div class="text-sm text-center px-2">
                        <p><strong>Atualizado em:</strong></p>
                        <span><?= (new Datetime($user->getUpdatedAt()))->format("d/m/Y H:i") ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row flex flex-wrap justify-between w-100">
            <div class="form-group w-47">
                <?= InputIcon::render(
                    label: "Nome completo",
                    required: "true",
                    name: "name",
                    iconLeft: '<i class="bi bi-person"></i>',
                    value: $user->getName()
                ); ?>
            </div>
            <div class="form-group  w-47">
                <?= DateIcon::render(
                    label: "Aniversário",
                    required: "true",
                    name: "birthdate",
                    iconLeft: '<i class="bi bi-calendar2-heart"></i>',
                    value: $user->getBirthdate()
                ); ?>
            </div>
        </div>
        <div class="form-row flex justify-between w-100">
            <div class="form-group  w-47">
                <?= InputIcon::render(
                    label: "Documento",
                    required: "true",
                    name: "document",
                    iconLeft: '<i class="bi bi-person-badge"></i>',
                    value: $user->getDecryptDocument()
                ); ?>
            </div>
            <div class="form-group w-47">
                <?= InputIcon::render(
                    label: "A palavra chave para recuperação de conta",
                    name: "keyword",
                    iconLeft: '<i class="bi bi-key"></i>',
                    value: $user->getDecryptKeyword()
                ); ?>
            </div>
        </div>
        <div class="form-row flex flex-wrap justify-between w-100">
            <div class="form-group  w-47">
                <?= Phone::render(
                    label: "Telefone",
                    required: "true",
                    name: "phone",
                    value: $user->getDecryptPhone()
                ); ?>
            </div>
            <div class="form-group  w-47">
                <?= EmailIcon::render(
                    label: "E-mail",
                    required: "true",
                    name: "email",
                    iconLeft: true,
                    value: $user->getDecryptEmail()
                ); ?>
            </div>
        </div>
        <div class="w-30 mx-auto mt-6">
            <?= Submit::render(
                text: "Atualizar"
            ) ?>
        </div>
    </form>
</div>