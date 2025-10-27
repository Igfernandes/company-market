<?php

declare(strict_types=1);

use App\Components\Shared\Layouts\Image\Image;

/**
 *  Template base para novos componentes
 *  Component: item
 *  Caminho: components/shared/layouts/slides/profile/item
 */

?>

<div component="profile:item" class=" min-h-[20vh] ">
    <div class="content text-center bg-white rounded-lg pb-5">
        <div component='profile:item-logotype'>
            <div class="border-2 text-white border-white inline-block">
                <?= Image::render(
                    class: "object-contain",
                    src: $logotype
                ) ?>
            </div>
        </div>
        <div class="bg-red-400 min-h-[4rem] flex items-center justify-center" component='profile:item-name'>
            <h3 class="font-poppins text-white"> <?= $name ?></h3>
        </div>
        <div>
            <span class="text-xs">
                <u><i>Cliente desde <?= date("d/m/Y", strtotime($created_at)) ?></i></u>
            </span>
        </div>
        <div class="md:px-2 mt-4 text-white" component='profile:item-text'>
            <ul class="flex justify-center header-sm">
                <?php if (isset($social_media['facebook'])): ?>
                    <li class="w-15 mx-1">
                        <a class="inline-block" href="<?= $social_media['facebook'] ?>" target="_blank" rel="noopener noreferrer">
                            <i class="text-red-400 bi bi-facebook"></i>
                        </a>
                    </li>
                <?php endif;
                if (isset($social_media['instagram'])) : ?>
                    <li class="w-15 mx-1">
                        <a href="<?= $social_media['instagram'] ?>" target="_blank" rel="noopener noreferrer">
                            <i class="text-red-400 bi bi-instagram"></i>
                        </a>
                    </li>
                <?php endif;
                if (isset($social_media['whatsapp'])) : ?>
                    <li class="w-15 mx-1">
                        <a href="<?= $social_media['whatsapp'] ?>" target="_blank" rel="noopener noreferrer">
                            <i class="text-red-400 bi bi-whatsapp"></i>
                        </a>
                    </li>
                <?php endif;
                if (isset($social_media['google'])) : ?>
                    <li class="w-15 mx-1">
                        <a href="<?= $social_media['google'] ?>" target="_blank" rel="noopener noreferrer">
                            <i class="text-red-400  bi bi-google"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>