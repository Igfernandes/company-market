<?php

use App\Components\Private\Header\Header;
use App\Components\Private\Sidebar\Sidebar;
use App\Components\Shared\Layouts\Head\Head;
use App\Components\Shared\Layouts\Scripts\Scripts;

Head::render();
?>
<div class="bg-dashboard w-100">
    <div class="row flex w-100">
        <?= Sidebar::render() ?>
        <div class="w-100">
            <?= Header::render() ?>
            <?= $content ?>
        </div>
    </div>
</div>
<?= Scripts::render(); ?>