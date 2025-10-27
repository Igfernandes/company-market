<?php

declare(strict_types=1);

use App\Components\Public\Footer\Footer;
use App\Components\Shared\Forms\Fields\Date\DateFloatLabel\DateFloatLabel;
use App\Components\Shared\Forms\Fields\Input\InputFloatLabel\InputFloatLabel;
use App\Components\Shared\Forms\Fields\Submit\Submit;
use App\Components\Shared\Forms\Variants\GroupValidations\GroupValidations;
use App\Components\Shared\Layouts\Head\Head;
use App\Components\Shared\Layouts\Image\Image;
use App\Components\Shared\Utils\Recaptcha\Recaptcha;

Head::render(title: "Criar conta - Nautisys System");
?>

<div class="login bg-blue-100 flex flex-col justify-center h-[100vh] w-100">
    <div class="content-forgot content w-75 mx-auto xll:w-90">
        <div class="row my-4 ">
            <div class="user-create col w-45 min-w-[19rem] bg-white rounded-r-lg mx-auto py-12 px-4 rounded-md shadow-lg">
                <form class="flex flex-col justify-center h-100 px-6" data-send="user-create">
                    <div class="form-header text-center">
                        <div class="form-icon w-20 mx-auto xxl:w-25">
                            <?= Image::render(src: "/images/nautisys-icon.png", alt: "Icon of NautiSys") ?>
                        </div>
                        <div class="form-title mt-2">
                            <h2 class="forgot-title header-xs xxl:header-md">Crie sua conta</h2>
                        </div>
                        <div class="text-justify mt-3">
                            <p class="forgot-text text-md text-gray-500 line-[1.2] xxl:text-xl">Nós informe o seus dados para finalizar a conta.</p>
                        </div>
                    </div>
                    <div class="form-content w-100 mt-4">
                        <div class="form-group">
                            <?= InputFloatLabel::render(
                                name: "document",
                                id: "document",
                                label: "Documento (CPF ou Passaporte)"
                            ) ?>
                        </div>
                        <div class="form-group">
                            <?= DateFloatLabel::render(
                                name: "birthdate",
                                id: "birthdate",
                                label: "Data de Nascimento"
                            ) ?>
                        </div>
                        <div>
                            <?= GroupValidations::render(
                                name: "password",
                                id: "password",
                            ) ?>
                        </div>
                        <div class="form-btn text-center text-sm xxl:text-xl">
                            <?= Submit::render(text: "Criar Conta") ?>
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
