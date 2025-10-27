<?php

declare(strict_types=1);

/**
 *  Template base para novos componentes
 *  Component: card
 *  Caminho: components/shared/layouts/slides/cards/card
 */

?>

<div component="card" class="<?= $background ?> min-h-[20vh] p-4 rounded-xl">
    <div class="content text-center">
        <div class="header-xl  mt-5" component='card:icon'>
            <div class="border-2 text-white border-white rounded-full inline-block px-4 py-1">
                <?= $icon ?>
            </div>
        </div>
        <div class="mt-4" component='card:title'>
            <h3 class="font-poppins text-white"> <?= $title ?></h3>
        </div>
        <div class="md:px-2 mt-4 text-white" component='card:text'>
            <p> <?= $text ?></p>
        </div>
    </div>
</div>