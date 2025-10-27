<?php

declare(strict_types=1);

use App\Components\Public\Header\Navbar\Navbar;
use App\Components\Shared\Layouts\Image\Image;

/**
 *  Template base para novos componentes
 *  Component: header
 *  Caminho: components/public/home/header
 */

?>

<header component="header" id="home" class="absolute top-0 left-0 w-100 z-100">
    <div class="content">
        <div class="container mx-auto">
            <div class="flex items-center py-2 px-4 mx-auto">
                <div class="w-50 sm:w-20">
                    <div>
                        <?php Image::render(
                            src: "/images/logotype.png"
                        )
                        ?>
                    </div>
                </div>
                <div class="w-50 sm:w-80 text-right text-white none md:block">
                    <?php Navbar::render(); ?>
                </div>
            </div>
        </div>
    </div>
</header>