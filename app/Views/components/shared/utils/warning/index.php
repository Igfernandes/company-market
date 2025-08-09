<?php

use App\Components\Shared\Utils\Modal\Modal;
use App\Components\Shared\Utils\Warning\ActionButtons;

?>

<div component="warning">
    <?php
    Modal::render(
        title: $title,
        subtitle: $subtitle,
        message: $message,
        action: ActionButtons::render(left: [
            "component='warning:cancel'"
        ], right: [
            "component='warning:delete'"
        ])
    );
    ?>
</div>