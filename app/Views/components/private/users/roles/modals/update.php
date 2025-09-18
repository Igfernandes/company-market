<?php

use App\Components\Shared\Forms\Fields\Input\InputFloatLabel\InputFloatLabel;
use App\Components\Shared\Forms\Fields\Textarea\TextareaFloatLabel\TextareaFloatLabel;

?>
<form class="form" component="roles:form" send='role-update'>
    <div class="text-justify mb-5">
        <p>Substitua as informações abaixo para realizar a atualização</p>
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
</form>