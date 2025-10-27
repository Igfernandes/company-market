<?php

declare(strict_types=1);

use App\Components\Shared\Layouts\Slides\Profile\Item\Item;
use App\Components\Shared\Layouts\Slides\Slides;

/**
 *  Template base para novos componentes
 *  Component: Profile
 *  Caminho: components/shared/layouts/slides/profile
 */

$configs = [
    "autoplay" => $autoplay,
    "loop" => $loop,
    "spaceBetween" => $spaceBetween,
    "slidesPerView" => $slidesPerView,
];

if (is_array($breakpoints) && count($breakpoints) > 0)
    $configs['breakpoints'] =  $breakpoints;
if (is_array($autoplay) && count($autoplay))
    $configs['autoplay'] = $autoplay;
?>

<div component="profile">
    <?php Slides::render(
        id: $id,
        slides: array_map(fn($item) => Item::render(
            logotype: $item['logotype'],
            name: $item['name'],
            social_media: $item['social_media'] ?? [],
            created_at: $item['created_at'] ?? date("Y-m-d H:i:s")
        ), $items),
        configs: $configs
    ); ?>
</div>