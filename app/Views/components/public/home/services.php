<?php

declare(strict_types=1);

use App\Components\Shared\Layouts\Slides\Cards\Cards;
use App\Components\Shared\Layouts\Topics\Topics;

/**
 *  Template base para novos componentes
 *  Component: services
 *  Caminho: components/public/home/services
 */

helper("json");

?>

<div class="services pb-10 mt-5" id="services" component="services">
    <div class="container relative mx-auto ">
        <div class="content px-4 lg:px-2">
            <div class="topics relative z-50">
                <?php Cards::render(
                    id: "cards",
                    background: "bg-red-400",
                    fill: "text-white",
                    spaceBetween: 30,
                    slidesPerView: 3,
                    breakpoints: [
                        "0" => [
                            "slidesPerView" => 1
                        ],
                        "500" => [
                            "slidesPerView" => 2
                        ],
                        "800" => [
                            "slidesPerView" => 3
                        ]
                    ],
                    cards: [

                        [
                            "icon" => "<i class='bi bi-shop'></i>",
                            "title" => "Gráfica Online",
                            "text" => "Oferecemos serviços completos de impressão e design gráfico para sua empresa. Contrate-nos e tenha materiais de qualidade profissional."
                        ],
                        [
                            "icon" => "<i class='bi bi-pc-display-horizontal'></i>",
                            "title" => "Desenvolvimento Digital",
                            "text" => "Criamos sites, lojas virtuais e soluções digitais sob medida para o seu negócio. Fale conosco e impulsione sua presença online."
                        ],
                        [
                            "icon" => "<i class='bi bi-camera'></i>",
                            "title" => "Marketing Digital",
                            "text" => "Planejamos e executamos campanhas de marketing digital que geram resultados reais. Entre em contato e aumente suas vendas."
                        ],
                        [
                            "icon" => "<i class='bi bi-camera-reels'></i>",
                            "title" => "Produções Audio/Visuais",
                            "text" => "Produzimos vídeos, fotos e conteúdos audiovisuais profissionais para promover sua marca. Contrate nossos serviços e destaque-se."
                        ]
                    ]
                ) ?>
            </div>
            <div class="mt-16">
                <?php Topics::render(
                    id: "products-services",
                    title: "Serviços & Produtos",
                    topics: [
                        ...getJson("/public/json/mocks/topics/marketing.json"),
                        ...getJson("/public/json/mocks/topics/technology.json"),
                    ]
                ); ?>
            </div>
        </div>
    </div>
</div>