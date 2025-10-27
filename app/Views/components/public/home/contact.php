<?php

declare(strict_types=1);

use App\Components\Shared\Forms\Fields\Input\InputFloatLabel\InputFloatLabel;
use App\Components\Shared\Forms\Fields\Submit\Submit;
use App\Components\Shared\Forms\Fields\Textarea\TextareaFloatLabel\TextareaFloatLabel;
use App\Components\Shared\Layouts\Link\Link;

/**
 *  Template base para novos componentes
 *  Component: contact
 *  Caminho: components/public/home/contact
 */

?>

<div component="contact" class="contact">
    <div class="container relative mx-auto">
        <div class="content flex flex-wrap py-10 min-h-[50vh]">
            <div class="w-100 md:w-75 px-6">
                <form send="contact" class="bg-white h-full p-6 rounded-md">
                    <div class="form-title mb-4">
                        <h3 class="text-md sm:text-xl md:header-sm font-poppins mb-0">Entre em contato conosco</h3>
                        <p class="text-xs sm:text-sm md:text-md"><i>Nós envie um e-mail e solucione todas as suas dúvidas.</i></p>
                    </div>
                    <div class="form-row justify-between">
                        <div class="form-group w-full sm:w-48">
                            <?= InputFloatLabel::render(
                                name: "name",
                                label: "Nome completo",
                                required: "true"
                            ) ?>
                        </div>
                        <div class="form-group w-full sm:w-48">
                            <?= InputFloatLabel::render(
                                name: "email",
                                label: "E-mail",
                                required: "true"
                            ) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= InputFloatLabel::render(
                            name: "subject",
                            label: "Assunto",
                            required: "true"
                        ) ?>
                    </div>
                    <div class="form-group">
                        <?= TextareaFloatLabel::render(
                            name: "message",
                            label: "Mensagem",
                            required: "true",
                            maxLength: 500
                        ) ?>
                    </div>
                    <div class="form-submit">
                        <?= Submit::render(
                            text: "Enviar Mensagem",
                            id: "contact-submit"
                        ) ?>
                    </div>
                </form>
            </div>
            <div class="w-100 md:w-25 mx-4 mt-5 lg:mt-0 lg:mx-0">
                <ul class="text-white h-full px-4 pt-8 rounded-md" component='contact:information'>
                    <li class="mb-4">
                        <span class="text-sm"><strong>Telefone/WhatsApp</strong></span>
                        <?= Link::render(
                            text: "+55 (21) 98132-5543",
                            href: "https://wa.me/5521981325543?text=Ol%C3%A1.%20Estou%20interessado%20em%20saber%20mais%20sobre%20os%20produtos%20e%20servi%C3%A7os%20da%20company%20market."
                        ) ?>
                        <hr class="h-[.5rem] text-gray-100 mt-5">
                    </li>
                    <li class="mb-4">
                        <span class="text-sm"><strong>E-mail</strong></span>
                        <?= Link::render(
                            text: "contato@companymarket.com.br",
                            href: "mailto: contato@companymarket.com.br"
                        ) ?>
                        <hr class="h-[.5rem] text-gray-100 mt-5">
                    </li>
                    <li class="mb-4">
                        <span class="text-sm"><strong>Endereço</strong></span>
                        <p>Maricá, RJ - Brasil</p>
                        <hr class="h-[.5rem] text-gray-100 mt-5">
                    </li>
                    <li class="mb-4">
                        <span class="text-sm"><strong>Redes Sociais</strong></span>
                        <ul class="flex flex-wrap header-sm pt-2">
                            <li class="w-15 mx-1">
                                <a href="https://www.facebook.com/profile.php?id=100080021277573" target="_blank" rel="noopener noreferrer">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            </li>
                            <li class="w-15 mx-1">
                                <a href="https://www.instagram.com/companymarketbr" target="_blank" rel="noopener noreferrer">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            </li>
                            <li class="w-15 mx-1">
                                <a href="https://www.youtube.com/@central582" target="_blank" rel="noopener noreferrer">
                                    <i class="bi bi-youtube"></i>
                                </a>
                            </li>
                            <li class="w-15 mx-1">
                                <a href="https://share.google/UI00xy8BobNHuCpZu" target="_blank" rel="noopener noreferrer">
                                    <i class=" bi bi-google"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>