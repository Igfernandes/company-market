<?php

declare(strict_types=1);

/**
 *  Template base para novos componentes
 *  Component: slides
 *  Caminho: components/shared/layouts/slides
 */

$uid = $id ?? uniqid('swiper_');

?>

<div component="slides">
    <!-- Swiper -->
    <div class="swiper swiper-horizontal  swiper-backface-hidden <?= $class ?>" component='slides:container' slides-settings='<?= json_encode($configs) ?>' id="<?= $uid ?>">
        <div class="swiper-wrapper">
            <?php
            if (is_array($slides)):
                foreach ($slides as $slide): ?>
                    <div class="swiper-slide" component='slides:item'>
                        <?= $slide ?>
                    </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
    <?php if (isset($configs['pagination'])): ?>
        <div class="swiper-pagination" aria-hidden="true"></div>
    <?php endif;
    if (isset($configs['dots'])): ?>
        <div class="swiper-button-prev" aria-hidden="true"></div>
        <div class="swiper-button-next" aria-hidden="true"></div>
    <?php endif;
    if (isset($configs['scrollbar'])): ?>
        <div class="swiper-scrollbar" aria-hidden="true"></div>
    <?php endif; ?>
</div>