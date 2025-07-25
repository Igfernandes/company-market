<?php

declare(strict_types=1);

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
        try {
            return view("components/shared/" . join("/", $args));
        } catch (Exception $err) {
            throw new Exception("COMPONENT NOT FOUND", \NOT_FOUND);
        }
    }
}
