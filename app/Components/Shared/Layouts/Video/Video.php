<?php

/**
 * Template de geração de componentes
 *
 * ⚠️ Este arquivo contém placeholders (ex: Video, App\Components\Shared\Layouts\Video) que
 * são substituídos dinamicamente pelo comando `php spark component:make`.
 *
 */

namespace App\Components\Shared\Layouts\Video;

use App\Components\BaseComponents;

class Video extends BaseComponents
{
    const ORIGIN = "components/shared/layouts/video";
    const PROPS = [
        "class",
        "src",
        "default",
        "poster",
        "type",
        "autoplay",
        "loop",
        "muted",
        "controls",
        "attributes",
    ];

    public static function render(
        ?string $class = "",
        ?string $src = "",
        ?string $default = "",
        ?string $poster = "",
        ?string $type = "video/mp4",
        bool $autoplay = false,
        bool $loop = false,
        bool $muted = false,
        bool $controls = true,
        ?array $attributes = [],
    ) {
        Component(self::ORIGIN, compact(self::PROPS));
    }
}
