<?php

declare(strict_types=1);

use App\Components\Public\Footer\Footer;
use App\Components\Shared\Forms\Checkbox\Checkbox;
use App\Components\Shared\Forms\Email\Email;
use App\Components\Shared\Forms\Password\PasswordToggle\PasswordToggle;
use App\Components\Shared\Forms\Submit\Submit;
use App\Components\Shared\Layouts\Carousel\Carousel;
use App\Components\shared\Layouts\Head\Head;
use App\Components\Shared\Layouts\Image\Image;
use App\Components\Shared\Utils\Recaptcha\Recaptcha;

Head::render(title: "Login - Nautisys System");
?>

<div class="login bg-blue-100 flex flex-col justify-center h-[100vh] w-100">
    <div class="content w-75 mx-auto">
        <div class="row flex my-4 ">
            <div class="col w-1/2 bg-blue-700 rounded-l-lg">
                <?= Carousel::render(
                    class: "h-[80vh]",
                    slides: [
                        "/imgs/nautisys-image-white.png"
                    ]
                ) ?>
            </div>
            <div class="col w-1/2 bg-white rounded-r-lg">
                <form class="flex flex-col justify-center h-100 px-6" data-send="auth">
                    <div class="form-header text-center">
                        <div class="form-icon w-20 mx-auto">
                            <?= Image::render(src: "/imgs/nautisys-icon.png", alt: "Icon of NautiSys") ?>
                        </div>
                        <div class="form-title mt-2">
                            <h2 class="header-xs">Bem Vindo a NautiSys!</h2>
                        </div>
                        <div class="form-text mt-1">
                            <p class="text-md text-gray-500 line-1">Bem-vindo de volta! Acesse sua conta <br> para continuar navegando com praticidade e segurança.</p>
                        </div>
                    </div>
                    <div class="form-content px-8 mt-4">
                        <div class="form-group">
                            <?= Email::render(
                                name: "login",
                                id: "login",
                                label: "Login/E-mail",
                                icon: '<i class="bi bi-envelope-fill"></i>'
                            ) ?>
                        </div>
                        <div class="form-group">
                            <?= PasswordToggle::render(name: "password", id: "password", label: "Password") ?>
                        </div>
                        <div class="flex justify-between mt-2">
                            <div class="form-remember">
                                <?= Checkbox::render(name: "remember", id: "remember", label: "Lembrar-me") ?>
                            </div>
                            <div class="w-50 h-100 forgot-password">

                            </div>
                        </div>
                        <div class="form-footer mt-4">
                            <div class="form-btn text-center">
                                <?= Submit::render(text: "Conectar-se") ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
Recaptcha::render();
Footer::render();
