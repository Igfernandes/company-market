<?php

declare(strict_types=1);

use App\Components\Private\Header\Header;
use App\Components\Private\Sidebar\Sidebar;
use App\Components\Shared\Layouts\Head\Head;
use App\Components\Shared\Layouts\Scripts\Scripts;

Head::render();
$session = session();
$userAuth = $session->get(SESSION_KEY_AUTH_USER);

?>
<div class="bg-dashboard w-100">
    <div class="row flex w-100">
        <?= Sidebar::render(
            user: $userAuth
        ) ?>
        <div class="w-100">
            <?= Header::render() ?>
            <?= $content ?>
        </div>
    </div>
</div>
<?= Scripts::render(); ?>