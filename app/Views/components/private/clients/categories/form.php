<?php

use App\Components\Shared\Forms\Fields\Input\InputFloatLabel\InputFloatLabel;
use App\Components\Shared\Forms\Fields\Submit\Submit;
use App\Components\Shared\Forms\Fields\Textarea\TextareaFloatLabel\TextareaFloatLabel;

?>
<form class="form" component="categories:form" send='category-create'>
    <div class="text-justify mb-5">
        <p>Abaixo está o formulário responsável por criar as categorias relacionadas aos clientes e seus agrupamentos.</p>
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
    <div>
        <?= Submit::render(
            text: "Salvar"
        ); ?>
    </div>
</form>
