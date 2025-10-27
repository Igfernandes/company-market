<?php

declare(strict_types=1);

/**
 *  Template base para novos componentes
 *  Component: navigation
 *  Caminho: components/shared/layouts/topics/navigation
 */

?>

<aside component="topics:navigation">
    <div class="content bg-white py-4 px-6 rounded-lg min-h-[40vh]">
        <div>
            <h3 class="text-xl"><u>Tópicos</u></h3>
        </div>
        <div>
            <span class="text-xs text-gray-800"><i>Selecione uma opção para atualizar a lista.</i></span>
        </div>
        <ul class="font-poppins mt-4" component='topics:menu'>
            <?php foreach ($menu as $item): ?>
                <li component='topics:menu-item' class="font-semibold hover:text-red-400 cursor-pointer my-3">
                    <i class="bi bi-caret-right text-red-400"></i> <?= $item; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>