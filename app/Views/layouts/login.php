<?php

declare(strict_types=1);

use App\Components\Public\Footer\Footer;
use App\Components\Shared\Forms\Fields\Checkbox\Checkbox;
use App\Components\Shared\Forms\Fields\Email\EmailFloatLabel\EmailFloatLabel;
use App\Components\Shared\Forms\Fields\Password\Password;
use App\Components\Shared\Forms\Fields\Submit\Submit;
use App\Components\Shared\Layouts\Head\Head;
use App\Components\Shared\Layouts\Image\Image;
use App\Components\Shared\Layouts\Link\Link;
use App\Components\Shared\Utils\Recaptcha\Recaptcha;

Head::render(title: "Login - Company Market");
?>

<div class="login bg-black-300 flex flex-col justify-center h-[90vh] mb-2 relative z-0 w-100">
    <div class="content w-90 md:w-75 max-w-[70rem] mx-auto">
        <div class="row my-4">
            <div class="overlay absolute top-0 left-0 w-full h-full overflow-hidden" style="
    filter: brightness(0.3);">
                <?php Image::render(
                    src: "/images/banners/banner-login.jpg"
                ); ?>
            </div>
            <div class="col w-100 sm:w-60 lg:w-50 bg-white relative z-10 rounded-r-lg mx-auto">
                <form class="flex flex-col justify-center h-100 px-4 sm:px-6 py-10" data-send="auth">
                    <div class="form-header text-center">
                        <div class="form-icon w-20 mx-auto">
                            <?= Image::render(src: "/images/icon.png", alt: "Icon of NautiSys") ?>
                        </div>
                        <div class="form-title mt-2">
                            <h2 class="text-lg sm:text-md lg:header-xs">Bem Vindo a Company market!</h2>
                        </div>
                        <div class="form-text mt-1">
                            <p class="text-md sm:text-sm lg:text-md text-gray-500 line-1">Acesse sua conta <br> para continuar navegando com praticidade e segurança.</p>
                        </div>
                    </div>
                    <div class="form-content px-1 sm:px-8 mt-4">
                        <div class="form-group">
                            <?= EmailFloatLabel::render(
                                name: "login",
                                id: "login",
                                label: "Login/E-mail",
                                icon: '<i class="bi bi-envelope-fill"></i>'
                            ) ?>
                        </div>
                        <div class="form-group">
                            <?= Password::render(name: "password", id: "password", label: "Password") ?>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="form-remember w-35">
                                <?= Checkbox::render(
                                    class: "text-gray-600 text-sm lg:text-md",
                                    name: "remember-me",
                                    id: "remember",
                                    label: "Lembrar-me"
                                ) ?>
                            </div>
                            <div class="w-65 text-right forgot-password">
                                <?= Link::render(
                                    class: "hover:text-black-400 text-sm lg:text-md",
                                    text: "Esqueceu sua senha?",
                                    href: "/forgot-password"
                                ); ?>
                            </div>
                        </div>
                        <div class="form-footer mt-4">
                            <div class="form-btn text-center">
                                <?= Submit::render(text: "Conectar-se", class: "text-sm lg:text-md") ?>
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
