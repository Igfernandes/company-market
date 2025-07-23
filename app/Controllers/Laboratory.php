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

    public function components(string $path, string $name)
    {
        try {
            return view("components/shared/$path/$name");
        } catch (Exception $err) {
            throw new Exception("COMPONENT NOT FOUND", \NOT_FOUND);
        }
    }
}
