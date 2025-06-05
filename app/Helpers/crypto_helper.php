<?php

if (!function_exists('referenceHash')) {
    function referenceHash(string $value): string
    {
        return hash('sha256', $value);
    }
}
