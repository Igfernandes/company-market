<?php

use App\Components\Private\Settings\Board;
?>
<div component='settings'>
    <div class="cursor-pointer" data-popup='settings'>
        <i class="bi bi-sliders text-hover text-xl"></i>
    </div>
    <?= Board::render() ?>
</div>