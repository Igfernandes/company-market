<?php

namespace App\Controllers;

use Exception;

class Load extends BaseController
{
    public function Component(...$args)
    {

        $paths = array_map(fn($path) => ucfirst($path), $args);
        $class = 'App\\Components\\Shared\\' . join("\\", $paths) . "\\{$paths[count($paths) - 1]}";

        if (!class_exists($class)) {
            throw new \Exception("COMPONENT NOT FOUND", \NOT_FOUND);
        }

        $payload = $this->request->getVar();

        return $class::render(...$payload);
    }
}
