<?php

declare(strict_types=1);

use App\Components\Public\Footer\Footer;
use App\Components\Shared\Layouts\Head\Head;
use App\Components\Shared\Layouts\Scripts\Scripts;

Head::render(title: "Laboratory - Company Market");

?>
<div class="laboratory bg-laboratory">

    <?php echo Component("laboratory/header"); ?>
    <div class="content flex">
        <?php echo Component("laboratory/sidebar"); ?>
        <?php echo Component("laboratory/preview"); ?>
    </div>
</div>

<?php Scripts::render(scripts: [
    "/js/tests/execute.js?type=module"
]); ?>