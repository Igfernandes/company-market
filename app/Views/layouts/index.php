<?php

declare(strict_types=1);

use App\Components\Public\Footer\Footer;
use App\Components\Public\Header\Header;
use App\Components\Public\Home\Content\Content;
use App\Components\Shared\Layouts\Head\Head;

Head::render();
?>
<div component='home:content' class="relative">
    <?php
    Header::render();
    Content::render();
    ?>
</div>

<?php
Footer::render();
