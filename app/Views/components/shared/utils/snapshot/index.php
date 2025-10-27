<?php

use App\Components\Shared\Layouts\Image\Image;
use App\Components\Shared\Utils\Snapshot\SnapshotModal;

$sizes = [
    "sm" => "w-[4.5rem] h-[4.5rem]",
    "md" => "w-[7rem] h-[7rem]"
];
?>

<div component='snapshot' snapshot-target='<?= $ref ?>' snapshot-fetch='<?= $api ??  "" ?>' snapshot-operation="<?= $operation ?? "" ?>">
    <div class="relative <?= $sizes[$size ?? 'md'] ?> mx-auto" component="snapshot:image">
        <?= Image::render(
            src: $src,
            class: "{$sizes[$size ?? '']} rounded-full object-cover border-2 border-accent mx-auto",
            default: "/images/preview/preview-avatar.jpg"
        ) ?>
        <div component="snapshot:message" class="absolute left-0 top-0 bg-gray h-100 w-100 rounded-100 text-center text-sm flex align-items-center border-2 border-accent">
            <span>Clique para editar</span>
        </div>
    </div>
    <?php SnapshotModal::render(
        id: $ref
    ); ?>
</div>


<script src="https://scaleflex.cloudimg.io/v7/plugins/filerobot-image-editor/latest/filerobot-image-editor.min.js"></script>