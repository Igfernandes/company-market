<?php

namespace App\Components\Shared\Layouts\Video;

class Mock
{
    public const PROPS = [
        "class" => "rounded-xl shadow-md",
        "src" => "/videos/demo.mp4",
        "default" => "/images/video-fallback.png",
        "poster" => "/images/video-poster.png",
        "type" => "video/mp4",
        "autoplay" => false,
        "loop" => false,
        "muted" => false,
        "controls" => true,
    ];
}
