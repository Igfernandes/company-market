<?php

use App\Components\Private\Layouts\Settings\Board;
?>
<div component='settings'>
    <div class="cursor-pointer" popup='settings'>
        <i class="bi bi-sliders text-theme text-xl"></i>
    </div>
    <?= Board::render() ?>
</div>