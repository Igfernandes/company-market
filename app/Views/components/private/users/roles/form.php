<?php

use App\Components\Shared\Forms\Fields\Input\InputFloatLabel\InputFloatLabel;
use App\Components\Shared\Forms\Fields\Button\Button;
use App\Components\Shared\Forms\Fields\Submit\Submit;
use App\Components\Shared\Forms\Fields\Textarea\TextareaFloatLabel\TextareaFloatLabel;

?>
<form class="form" component="roles:form" send='role-create'>
    <div class="text-justify mb-5">
        <p>Abaixo está o formulário responsável por criar as funções relacionadas aos usuários e seus agrupamentos.</p>
    </div>
    <div>
        <?= InputFloatLabel::render(
            name: "name",
            id: "name",
            label: "Título",
            required: "true"
        ) ?>
        <?= TextareaFloatLabel::render(
            name: "description",
            id: "description",
            maxLength: 200,
            label: "Descrição"
        ) ?>
    </div>
    <div class="mb-4">
        <?= Button::render(
            text: "Definir Permissões",
            class: "bg-blue-300 text-white",
            attributes: [
                "modal-target" => "permissions"
            ]
        ); ?>
    </div>
    <div>
        <?= Submit::render(
            text: "Salvar"
        ); ?>
    </div>
</form>
