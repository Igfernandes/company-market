<?php

use App\Components\Shared\Forms\Fields\Email\EmailFloatLabel\EmailFloatLabel;
use App\Components\Shared\Forms\Fields\Input\InputFloatLabel\InputFloatLabel;

?>
<form send="invite" class="w-[25vw]">
    <div class="form-title mb-6">
        <p class="font-semibold ">Convide um novo usuário preenchendo abaixo.
        </p>
    </div>
    <div class="form-group">
        <?= InputFloatLabel::render(
            name: "name",
            label: "Nome Completo",
            required: "true"
        ); ?>
    </div>
    <div class="form-group">
        <?= EmailFloatLabel::render(
            name: "email",
            label: "E-mail",
            required: "true"
        ); ?>
    </div>
    <div class="form-alert mt-6">
        <p><i>Ele receberá um e-mail com as instruções de acesso.</i></p>
    </div>
</form>