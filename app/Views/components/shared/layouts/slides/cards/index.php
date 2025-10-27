<?php

declare(strict_types=1);

use App\Components\Shared\Layouts\Slides\Cards\Card\Card;
use App\Components\Shared\Layouts\Slides\Slides;

/**
 *  Template base para novos componentes
 *  Component: cards
 *  Caminho: components/shared/layouts/slides/cards
 */

$configs = [
    "loop" => $loop,
    "spaceBetween" => $spaceBetween,
    "slidesPerView" => $slidesPerView,
];

if (is_array($breakpoints) && count($breakpoints) > 0)
    $configs['breakpoints'] =  $breakpoints;
if (is_array($autoplay) && count($autoplay))
    $configs['autoplay'] = $autoplay;
?>

<div component="cards">
    <?php Slides::render(
        id: $id,
        slides: array_map(fn($card) => Card::render(
            icon: $card['icon'],
            title: $card['title'],
            text: $card['text'] ?? ""
        ), $cards),
        configs: $configs
    ); ?>
</div>