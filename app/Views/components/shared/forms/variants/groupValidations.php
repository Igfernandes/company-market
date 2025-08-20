<?php

declare(strict_types=1);

use App\Components\Shared\Forms\Fields\Password\Password;

$dataCriterion = [
    'lowercase' => 'Pelo menos 1 letra minúscula',
    'number' => 'Pelo menos 1 número',
    'uppercase' => 'Pelo menos 1 letra maiúscula',
    'min' => 'Pelo menos 8 caracteres',
    'symbol' => 'Pelo menos 1 caractere especial'
];
?>

<div class="password-group" component="group-validation">
    <div class="p-relative mb-2">
        <div class="mb-0" component='password:new-password'>
            <?php
            Password::render(
                name: $name,
                id: $id,
                label: "Senha",
                required: $required ?? "true",
            );
            ?>
        </div>
    </div>
    <div>
        <ul class="flex flex-wrap text-gray-600">
            <?php foreach ($dataCriterion as $criterion => $text): ?>
                <li class="validations-password mr-2" criterion="<?= $criterion ?>">
                    <div class='flex items-center'>
                        <span>
                            <i class="bi bi-check-circle"></i>
                        </span>
                        <div class='text-sm ml-2'>
                            <p class="text-validate"><?= $text ?></p>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="p-relative mt-4 mb-2">
        <div class="password-confirmation" component='password:confirmation'>
            <?php
            Password::render(
                name: "confirmation",
                id: "confirmation",
                label: "Confirmação de Senha",
                required: $required ?? "true",
            );
            ?>
        </div>
    </div>
</div>