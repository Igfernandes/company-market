<?php

declare(strict_types=1);

use App\Components\Private\Layouts\Sidebar\Navbar;
use App\Components\Private\Layouts\Sidebar\Toggle;
use App\Components\Shared\Layouts\Image\Image;
use App\Database\Entities\Users\UserEntity;

/** @var UserEntity $user */


?>
<aside component="sidebar" class="">
    <div class="content-sidebar relative w-[16vw] h-[100vh] bg-content pt-4 shadow">
        <div class="">
            <div class="mobile-action absolute">
                <?=
                Toggle::render();
                ?>
            </div>
            <div class="avatar">
                <?= Image::render(
                    src: $user->getAvatar(),
                    class: "w-40 h-[4.5rem] rounded-full border-2 border-accent mx-auto",
                    default: "/images/preview/preview-avatar.jpg"
                ) ?>
            </div>
            <div class="username text-center mt-2 mb-1">
                <span class="font-poppins font-medium">
                    <?= $user->getName() ?>
                </span>
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