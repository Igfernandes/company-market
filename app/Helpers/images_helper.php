<?php

if (!function_exists('getUrlAvailable')) {
    function getUrlAvailable(string $url, ?string $default = "")
    {
        if (empty($url))
            return $default;

        $headers = @get_headers($url);
        if ($headers && strpos($headers[0], '200') !== false) {
            return $url;
        } else {
            return $default;
        }
    }
}
