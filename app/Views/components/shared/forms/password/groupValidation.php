<?php

declare(strict_types=1);

use App\Components\Shared\Forms\Password\PasswordToggle\PasswordToggle;


$dataCriterion = [
    'caracteres' => 'Pelo menos 8 caracteres',
    'maiuscula' => 'Pelo menos 1 letra maiúscula',
    'minuscula' => 'Pelo menos 1 letra minúscula',
    'numero' => 'Pelo menos 1 número',
    'caractere especial' => 'Pelo menos 1 caractere especial',
    'confirmation' => 'A senha informada deve ser igual à senha de confirmação'
];
?>

<div class="password-group" component="group-validation">
    <div class="p-relative mb-2">
        <div class="mb-0" component='password:new-password'>
            <?php
            PasswordToggle::render(
                name: "new-password",
                id: "new-password",
                label: "New Password",
                required: $required ?? "true",
            );
            ?>
        </div>
    </div>
    <div>
        <div class="row">
            <?php foreach ($dataCriterion as $criterion => $text): ?>
                <div class="validations-password" data-criterion="group-validation:<?= $criterion ?>">
                    <div class='flex items-center'>
                        <span>
                            <i class="bi bi-check-circle text-green-300"></i>
                        </span>
                        <div class='ml-2'>
                            <p class="text-validate"><?= $text ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="p-relative mt-4 mb-4">
        <div class="password-confirmation" component='password:confirmation'>
            <?php
            PasswordToggle::render(
                name: "confirmation",
                id: "confirmation",
                label: "Confirm Password",
                required: $required ?? "true",
            );
            ?>
        </div>
        <div class="confirmation-password" data-criterion-password='confirmation'>
            <div class='ml-1'>
                <p class="text-validate">A senha informada deve ser igual à senha de confirmação</p>
            </div>
        </div>
    </div>