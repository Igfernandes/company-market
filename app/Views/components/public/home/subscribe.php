<?php

declare(strict_types=1);

use App\Components\Shared\Forms\Fields\Email\EmailFloatLabel\EmailFloatLabel;
use App\Components\Shared\Forms\Fields\Submit\Submit;

/**
 *  Template base para novos componentes
 *  Component: subscribe
 *  Caminho: components/public/home/subscribe
 */

?>

<div component="subscribe" class="subscribe relative">
    <div class="overlay absolute top-0 left-0 bg-black opacity-30 w-full h-full"></div>
    <div class="container relative mx-auto">
        <div class="content relative flex items-center justify-center min-h-[40vh]">
            <form send="subscribe" class="w-90 md:w-70 bg-white py-5 px-4 shadow-md rounded-md">
                <div class="form-title mb-4">
                    <h2 class="text-xl text-red-400 font-poppins text-center md:text-left">Inscreva-se para receber novidades</h2>
                    <p class="text-sm text-justify md:text-left"><i>Acompanhe as principais tendências e avanços tecnológicos para se manter competitivo e relevante no mercado.</i></p>
                </div>
                <div class="form-row flex justify-between">
                    <div class="form-group w-full md:w-83">
                        <?= EmailFloatLabel::render(
                            name: "email",
                            id: "subscribe-email",
                            label: "Insira o seu melhor e-mail",
                        ) ?>
                    </div>
                    <div class="form-submit w-full md:w-15">
                        <?= Submit::render(
                            id: "subscribe-submit",
                            text: "Inscrever-me",
                        ) ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>