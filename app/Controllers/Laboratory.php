<?php

namespace App\Controllers;

use Exception;

class Laboratory extends BaseController
{
    public function index($component = null)
    {
        $data['component'] = $component;
        return view('laboratory', $data);
    }

    public function components(...$args)
    {
        $paths = array_map(fn($path) => ucfirst($path), $args);
        $class = 'App\\Components\\' . join("\\", $paths)."\\{$paths[count($paths) - 1]}";

        if (!class_exists($class)) {
            throw new \Exception("COMPONENT NOT FOUND", \NOT_FOUND);
        }

        $payload = $this->request->getVar();

        if(isset($payload['mock']) ){
            $mockClass = 'App\\Components\\' . join("\\", array_map(fn($path) => ucfirst($path), $args)).'\\Mock';
        
            if(class_exists($mockClass))
            $payload = $mockClass::PROPS;
        }
        
        return Component(new $class(...$payload));
    
    }
}
