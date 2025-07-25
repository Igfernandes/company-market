<?php

use App\Components\BaseComponents;

if (!function_exists('Component')) {
    function Component(BaseComponents $instance): string
    {
        return view($instance->origin, $instance->props);
    }
}
