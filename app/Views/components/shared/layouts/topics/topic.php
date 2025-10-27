<?php

declare(strict_types=1);

use App\Components\Shared\Layouts\Buttons\BtnPrimary\BtnPrimary;
use App\Components\Shared\Layouts\Image\Image;

/**
 *  Template base para novos componentes
 *  Component: topic
 *  Caminho: components/shared/layouts/topics/topic
 */

?>

<div component="topic" topic-ref='<?= $ref ?>' class="bg-white min-h-[45vh] rounded-md p-3 mb-5">
    <div>
        <div class="relative">
            <div class="relative z-10 mb-2" component='topic:price'>
                <span class="bg-red-400 text-white rounded-sm p-2"><?= $price > 0 ? "A partir de R$: " .  number_format($price, 2, ',', '.')  : "Sob Consulta" ?></span>
            </div>
            <div component='topic:image' class="h-[20vh]">
                <?= Image::render(
                    src: $image,
                    class: "object-contain",
                    alt: "Topic $ref"
                ) ?>
            </div>
        </div>
        <div component='topic:information mt-2'>
            <div class="text-center" component='topic:title'>
                <h4 class="font-poppins"><?= $title ?></h4>
            </div>
            <div class="text-justify mt-3" component='topic:text'>
                <p class="text-sm"><?= $text ?></p>
            </div>
        </div>
        <?php if (!empty($link)): ?>
            <div component='topic:action' class="text-center mt-6 mb-2">
                <?= BtnPrimary::render(
                    link: $link,
                    text: "Solicitar Consulta"
                ) ?>
            </div>
        <?php endif; ?>
    </div>
</div>