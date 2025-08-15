<?php

use App\Components\Private\Settings\Settings;
use App\Components\Private\Header\Translate;
use App\Components\Private\MsgCenter\MsgCenter;
use App\Components\Private\Sidebar\Toggle;
use App\Components\Shared\Forms\Search\Search;
use App\Components\Shared\Utils\Notification\Notification;

?>
<header class="bg-content w-100 shadow-sm">
    <div class="row flex items-center pt-3 px-4">
        <?php
        Toggle::render();
        ?>
        <div class="mr-2 md:mr-0">
            <?=
            Search::render(
                label: "Buscar...",
            );
            ?>
        </div>
        <div class="flex items-center ml-auto">
            <div class="mr-3">
                <?php MsgCenter::render(); ?>
            </div>
            <div>
                <?php Notification::render(); ?>
            </div>
            <div class="ml-5">
                <?php Settings::render(); ?>
            </div>
            <div>
                <?php Translate::render(); ?>
            </div>
        </div>
    </div>
</header>