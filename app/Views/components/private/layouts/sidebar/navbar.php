<?php

use App\Components\Private\Layouts\Sidebar\SubMenu;

$icon = [
    "overview" => '<i class="bi bi-house-door"></i>',
    "logout" => '<i class="bi bi-box-arrow-right"></i>',
    "news" => '<i class="bi bi-newspaper"></i>',
    "statistics" => '<i class="bi bi-thermometer-sun"></i>',
    "clients" => '<i class="bi bi-people"></i>',
    "boat" => '<i class="bi bi-life-preserver"></i>',
    'documents' => '<i class="bi bi-file-break"></i>',
    'forms' => '<i class="bi bi-pencil"></i>',
    'sales' => '<i class="bi bi-receipt"></i>',
    'charges' => '<i class="bi bi-cash-stack"></i>',
    'expenses' => '<i class="bi bi-clipboard-data"></i>',
    "coupons" => '<i class="bi bi-ticket-detailed"></i>',
    "sistema" => '<i class="bi bi-gear"></i>',
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
                                <a class="font-arial font-normal ml-1" href="<?= $slug ?>"> <?= $item ?></a>
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