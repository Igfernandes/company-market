<?php

if (!function_exists('getPublicUrl')) {
    function getPublicUrl(string|null $absoluteUrl): string|null
    {
        if (empty($absoluteUrl)) return $absoluteUrl;

        $absoluteUrl = preg_replace('/\\f/', '/f', $absoluteUrl);
        $absoluteUrl = str_replace(['\\', "uploads\\"], ['/', "uploads/"], $absoluteUrl);

        $arrUrl = explode('uploads/', $absoluteUrl);

        if (!isset($arrUrl[1])) return $absoluteUrl;

        $image = $arrUrl[1];

        return  base_url("/uploads/$image");
    }
}
