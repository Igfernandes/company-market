<?php

use App\Components\Private\Layouts\Sidebar\SubMenu;

$icon = [
    "overview" => '<i class="bi bi-house-door"></i>',
    "logout" => '<i class="bi bi-box-arrow-right"></i>',
    "dispatchers" => '<i class="bi bi-send"></i>',
    "clients" => '<i class="bi bi-people"></i>',
    "content" => '<i class="bi bi-file-break"></i>',
    "sistema" => '<i class="bi bi-gear"></i>',
    "companies" => '<i class="bi bi-shop"></i>',
    "users" => '<i class="bi bi-person-lock"></i>'
];
?>

<div class="menu h-[70vh] overflow-y-auto pl-5 pb-4">
    <?php
    if (isset($menu)):
        foreach ($menu as $topic => $itens):
    ?>
            <div class="navbar  mt-3 pt-2">
                <div class="topic cursor-pointer ">
                    <span class="font-medium text-md font-poppins text-active"><?= $topic ?></span>
                </div>
                <ul class="px-2 rounded-xs">
                    <?php foreach ($itens as $slug => $item): ?>
                        <li class="text-black-800  my-1">
                            <div class="menu-item">
                                <?= isset($icon[$slug]) ? $icon[$slug] : "" ?>
                                <a class="font-arial font-normal ml-1" href="<?= $slug ?>"> <?= ucfirst($item) ?></a>
                            </div>
                            <?= SubMenu::render(
                                topic: $slug
                            ); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
    <?php endforeach;
    endif;
    ?>
</div>