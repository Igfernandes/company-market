<?php

namespace App\Components;

class BaseComponents
{
    public string $origin = "";
    public array $props = [];

    public function __construct(mixed ...$args) {
        $this->props = func_get_args();
    }
}