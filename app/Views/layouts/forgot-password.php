<?php

declare(strict_types=1);

use App\Components\Public\Footer\Footer;
use App\Components\Shared\Forms\Fields\Email\EmailFloatLabel\EmailFloatLabel;
use App\Components\Shared\Forms\Fields\Submit\Submit;
use App\Components\Shared\Layouts\Head\Head;
use App\Components\Shared\Layouts\Image\Image;
use App\Components\Shared\Layouts\Link\Link;
use App\Components\Shared\Utils\Recaptcha\Recaptcha;

Head::render(title: "Login - Nautisys System");
?>

<div class="login bg-blue-100 flex flex-col justify-center h-[100vh] w-100">
    <div class="content-forgot content w-75 mx-auto xll:w-90">
        <div class="row my-4 ">
            <div class="forgot-password col w-45 min-w-[19rem] bg-white rounded-r-lg mx-auto py-12 px-4 rounded-md shadow-lg">
                <form class="flex flex-col justify-center h-100 px-6" data-send="forgot-password">
                    <div class="form-header text-center">
                        <div class="form-icon w-20 mx-auto xxl:w-25">
                            <?= Image::render(src: "/imgs/nautisys-icon.png", alt: "Icon of NautiSys") ?>
                        </div>
                        <div class="form-title mt-2">
                            <h2 class="forgot-title header-xs xxl:header-md">Recupere a sua senha</h2>
                        </div>
                        <div class="text-justify mt-1">
                            <p class="forgot-text text-md text-gray-500 line-[1.2] xxl:text-xl">Nós informe o seu e-mail cadastrados para que possamos enviar um link de recuperação de conta.</p>
                        </div>
                    </div>
                    <div class="form-content w-100 mt-4">
                        <div class="form-group">
                            <?= EmailFloatLabel::render(
                                name: "email",
                                id: "email",
                                label: "E-mail"
                            ) ?>
                        </div>
                        <div class="form-btn text-center text-sm xxl:text-xl">
                            <?= Submit::render(text: "Recuperar senha") ?>
                        </div>
                    </div>
                </form>

                <div class="link-login text-center mt-10 xxl:header-xs">
                    <?= Link::render(
                        text: "Já lembra sua senha? Entre agora",
                        class: "text-sm md:text-md hover:text-gray-300",
                        href: "/login"
                    ) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
Recaptcha::render();
Footer::render();
