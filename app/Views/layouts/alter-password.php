<?php

declare(strict_types=1);

use App\Components\Public\Footer\Footer;
use App\Components\Shared\Forms\Fields\Submit\Submit;
use App\Components\Shared\Forms\Variants\GroupValidations\GroupValidations;
use App\Components\Shared\Layouts\Head\Head;
use App\Components\Shared\Layouts\Image\Image;
use App\Components\Shared\Layouts\Link\Link;
use App\Components\Shared\Utils\Recaptcha\Recaptcha;

Head::render(title: "Alter Password - Nautisys System");
?>

<div class="alter-password bg-blue-100 flex flex-col justify-center h-[100vh] w-100">
    <div class="content w-75 mx-auto">
        <div class="row my-4 ">
            <div class="col w-45 min-w-[25rem] bg-white rounded-r-lg mx-auto py-12 px-4 rounded-md shadow-lg">
                <form class="flex flex-col justify-center h-100 px-6" data-send="alter-password">
                    <div class="form-header text-center">
                        <div class="form-icon w-20 mx-auto">
                            <?= Image::render(src: "/imgs/nautisys-icon.png", alt: "Icon of NautiSys") ?>
                        </div>
                        <div class="form-title mt-2">
                            <h2 class="header-xs">Recupere a sua senha</h2>
                        </div>
                        <div class="text-justify mt-1">
                            <p class="text-md text-gray-500 line-[1.2]">Nós informe o seu e-mail cadastrados para que possamos enviar um link de recuperação de conta.</p>
                        </div>
                    </div>
                    <div class="form-content w-100 mt-4">
                        <div class="form-group">
                            <?= GroupValidations::render(
                                name: "password",
                                id: "password",
                            ) ?>
                        </div>
                        <div class="form-btn text-center">
                            <?= Submit::render(text: "Recuperar senha") ?>
                        </div>
                    </div>
                </form>

                <div class="link-login text-center mt-10">
                    <?= Link::render(
                        text: "Já lembra sua senha? Entre agora",
                        class: "hover:text-gray-300"
                    ) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
Recaptcha::render();
Footer::render();
