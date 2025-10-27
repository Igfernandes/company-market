<?php

declare(strict_types=1);

use App\Components\Shared\Layouts\Slides\Profile\Profile;
use App\Components\Shared\Layouts\Slides\Slides;

/**
 *  Template base para novos componentes
 *  Component: clients
 *  Caminho: components/public/home/clients
 */

helper("json");
?>

<div component="clients" id="clients" class="clients">
    <div class="container relative mx-auto">
        <div class="content min-h-[60vh] py-24 mx-4 lg:mx-0">
            <?= Profile::render(
                id: "clients-profiles",
                autoplay: false,
                breakpoints: [
                    "0" => [
                        "slidesPerView" => 1
                    ],
                    "500" => [
                        "slidesPerView" => 3
                    ],
                    "800" => [
                        "slidesPerView" => 5
                    ],
                ],
                items: [
                    ...getJson("/public/json/mocks/clients.json")
                ],
                slidesPerView: 5,
                loop: true,
                spaceBetween: 30
            ); ?>
        </div>
    </div>
</div>