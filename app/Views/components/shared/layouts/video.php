<?php

declare(strict_types=1);

/**
 *  Template base para novos componentes
 *  Component: video
 *  Caminho: components/shared/layouts/video
 */

?>

<div component="video">
    <video
        class="w-full h-full <?= $class ?? '' ?>"
        src="<?= $src ?>"
        poster="<?= $poster ?? $default ?>"
        <?= !empty($autoplay) && $autoplay ? 'autoplay' : '' ?>
        <?= !empty($loop) && $loop ? 'loop' : '' ?>
        <?= !empty($muted) && $muted ? 'muted' : '' ?>
        <?= !empty($controls) && $controls ? 'controls' : '' ?>
        playsinline
        loop
        onerror="
        this.onerror=null;
        this.outerHTML = `<img 
            component='video-fallback' 
            class='w-full h-full <?= $class ?? '' ?>' 
            src='<?= $default ?>' 
            alt='fallback image'>`;
    "
        <?= getAttributes($attributes) ?>>
        <source src="<?= $src ?>" type="<?= $type ?? 'video/mp4' ?>">
        <img src="<?= $default ?>" alt="fallback image">
    </video>
</div>