<?php

declare(strict_types=1);

use App\Components\Shared\Layouts\Buttons\BtnPrimary\BtnPrimary;
use App\Components\Shared\Layouts\Video\Video;

/**
 *  Template base para novos componentes
 *  Component: presentation
 *  Caminho: components/public/home/presentation
 */

?>

<main class="presentation lg:min-h-[100vh]" component="presentation">
    <div class="overlay absolute top-0 left-0 w-full h-full md:min-h-[100vh] overflow-hidden" style="
    filter: brightness(0.3);">
        <?php Video::render(
            class: "",
            src: "/videos/banner.mp4",
            autoplay: true,
            muted: true,
            controls: false,
            default: "/images/banners/fallback-video.png"
        ); ?>
    </div>
    <div class="container relative mx-auto">
        <div class="content px-6 lg:px-2 pt-24 lg:pt-40">
            <div class="text-white text-center md:text-left">
                <span class="font-600 text-xs sm:text-sm md:text-md">DÊ VIDA A SUAS IDEIAS</span>
                <h1 class="header-xs md:header-lg font-8 font-poppins">Inovando o seu negócio</h1>
            </div>
            <div class="w-100 lg:w-60 mt-5 ">
                <p class="text-white text-justify text-sm lg:text-md">
                    Na <strong>Company Market</strong>, unimos criatividade, tecnologia e estratégia para impulsionar o crescimento do seu negócio.
                    Somos especialistas em <strong>marketing digital</strong> e <strong>desenvolvimento digital</strong>, oferecendo soluções completas que fortalecem sua marca e ampliam seu alcance.
                    De <strong>fotografia e filmagens profissionais</strong> a <strong>produção digital e gestão de mídias sociais</strong>, entregamos inovação e performance para empreendedores em todo o Brasil.
                    Com câmeras estáticas, panorâmicas e 360°, e estratégias modernas, transformamos ideias em experiências visuais que conectam e geram resultados.
                    A Company Market é o parceiro ideal para quem quer ir além — crescer, engajar e conquistar no mundo digital.
                </p>
            </div>
            <div class="mt-4 lg:mt-10">
                <?= BtnPrimary::render(
                    link: "",
                    text: "Solicite Orçamento!"
                ) ?>
            </div>
        </div>
     
    </div>
</main>