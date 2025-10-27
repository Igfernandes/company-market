<?php

declare(strict_types=1);

/**
 *  Template base para novos componentes
 *  Component: BtnPrimary
 *  Caminho: components/shared/layouts/buttons/BtnPrimary
 */

?>

<div component="btn-primary">
    <a href="<?= $link ?>" class="bg-red-400 text-sm lg:text-md inline-block font-600 hover:bg-white border-2 hover:text-red-400 border-red-400 px-6 text-white py-3 shadow-md rounded">
        <?= $text ?>
    </a>
</div>