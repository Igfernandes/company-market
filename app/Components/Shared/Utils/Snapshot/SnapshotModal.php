<?php

namespace App\Components\Shared\Utils\Snapshot;

use App\Components\BaseComponents;
use App\Components\Shared\Utils\Modal\Modal;

class SnapshotModal extends BaseComponents
{
    const ORIGIN = "components/shared/utils/snapshot/modal";
    const PROPS = [
        'id'
    ];

    public static function render(
        string $id = "",
    ) {
        return Modal::render(
            title: "Editor Imagens",
            type: "snapshot_$id",
            content: Component(self::ORIGIN, compact(self::PROPS), true)
        );
    }
}
