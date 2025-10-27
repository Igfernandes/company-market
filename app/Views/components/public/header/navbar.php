<?php

declare(strict_types=1);

use App\Components\Shared\Layouts\Buttons\BtnPrimary\BtnPrimary;

/**
 *  Template base para novos componentes
 *  Component: navbar
 *  Caminho: components/public/header/navbar
 */

?>

<div component="navbar" class="ml-auto inline-block">
    <ul class="flex items-center">
        <?php foreach ($menu as $li): ?>
            <li class="mx-2">
                <a class="hover:text-red-400 text-sm md:text-md" href="<?= $li['link'] ?>">
                    <?= $li['text'] ?>
                </a>
            </li>
        <?php endforeach; ?>
        <li class="ml-4">
            <?= BtnPrimary::render(
                link: "https://wa.me/5521981325543?text=Ol%C3%A1.%20Estou%20interessado%20em%20come%C3%A7ar%20u",
                text: "Seja Vendedor"
            ) ?>
        </li>
    </ul>
</div>