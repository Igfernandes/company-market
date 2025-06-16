<?php

if (!function_exists('getPublicUrl')) {
    function getPublicUrl(string $absoluteUrl): string
    {
        $absoluteUrl = str_replace('\\', '/', $absoluteUrl);
        $arrUrl = explode('uploads/', $absoluteUrl);

        if (!isset($arrUrl[1])) return $absoluteUrl;

        $image = $arrUrl[1];

        return getenv('CI_ENVIRONMENT') === 'development' ? getenv('globals.href.backend') . "/uploads/$image" :  base_url("/uploads/$image");
    }
}
