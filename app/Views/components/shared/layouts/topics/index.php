<?php

declare(strict_types=1);

use App\Components\Shared\Layouts\Slides\Slides;
use App\Components\Shared\Layouts\Topics\Navigation\Navigation;
use App\Components\Shared\Layouts\Topics\Topic\Topic;

/**
 *  Template base para novos componentes
 *  Component: topics
 *  Caminho: components/shared/layouts/topics/index
 */

$arrayWithRefs = [];
foreach ($topics as $topic) {
    $arrayWithRefs[$topic['ref']] = $topic['ref'];
}
$menu = array_values($arrayWithRefs);
?>

<div component="topics" topic-target='<?= !empty($default) ? $default : $menu[0] ?>'>
    <div class="content">
        <div class="title text-center">
            <h1 class="text-white header-md">
                <?= $title ?>
            </h1>
        </div>
        <div class="mt-2 mb-6">
            <hr>
        </div>
        <div class="flex flex-wrap">
            <div class="w-100 md:w-25">
                <?= Navigation::render(
                    menu: $menu
                ); ?>
            </div>
            <div class="w-100 md:w-75 mt-10 md:mt-0">
                <div component='topics:board' class=" px-4">
                    <?php
                    Slides::render(
                        id: $id,
                        configs: [
                            "slidesPerView" => 3,
                            "grid" => [
                                "rows" => 2,
                                "fill" => 'row', // pode ser 'row' ou 'column'
                            ],
                            "spaceBetween" => 30,
                            "breakpoints" => [
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
                        ],
                        slides: array_map(fn($topic) => Topic::render(
                            ref: $topic['ref'],
                            title: $topic['title'],
                            text: $topic['text'],
                            image: $topic['image'],
                            link: $topic['link'],
                            price: doubleval($topic['price'])
                        ), $topics)
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</div>