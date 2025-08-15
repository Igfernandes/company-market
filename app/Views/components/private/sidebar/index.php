<?php

use App\Components\Private\Sidebar\Navbar;
use App\Components\Private\Sidebar\Toggle;
use App\Components\Shared\Layouts\Image\Image;
?>
<aside component="sidebar" class="sticky top-0 left-0 min-w-[16vw]">
    <div class="content-sidebar relative w-[16vw] h-[100vh] bg-content pt-4 shadow">
        <div class="">
            <div class="mobile-action absolute">
                <?=
                Toggle::render();
                ?>
            </div>
            <div class="avatar">
                <?= Image::render(
                    src: "/imgs/preview/preview-avatar.jpg",
                    class: "w-40 rounded-full border-2 border-accent mx-auto"
                ) ?>
            </div>
            <div class="username text-center mt-2 mb-1">
                <span class="font-poppins font-medium">Igor Fernandes</span>
            </div>
            <div class="social-icons">
                <ul class="flex justify-center">
                    <li class="px-2 text-xl border-r-2 border-accent">
                        <i class="bi bi-whatsapp text-dark"></i>
                    </li>
                    <li class="px-2 text-xl border-r-2 border-accent">
                        <i class="bi bi-instagram text-dark"></i>
                    </li>
                    <li class="px-2 text-xl">
                        <i class="bi bi-twitter-x text-dark"></i>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="border-2 mt-4">
        <?= Navbar::render() ?>
    </div>
</aside>